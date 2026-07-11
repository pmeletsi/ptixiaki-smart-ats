<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Models\Candidate;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use OpenAI; 
use Smalot\PdfParser\Parser;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Υποψήφιοι';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('Όνομα')->required(),
                        Forms\Components\TextInput::make('email')->label('Email')->email()->required(),
                        Forms\Components\TextInput::make('phone')->label('Τηλέφωνο'),
                        Forms\Components\Select::make('job_id')->label('Αγγελία')->relationship('job', 'title')->required(),
                        Forms\Components\Select::make('status')
                            ->label('Κατάσταση')
                            ->options([
                                'new' => 'Νέα',
                                'interview' => 'Συνέντευξη',
                                'hired' => 'Πρόσληψη',
                                'rejected' => 'Απορρίφθηκε',
                            ])->required(),
                        
                        Forms\Components\FileUpload::make('resume_path')
                             ->label('Βιογραφικό (Αρχείο PDF)')
                             ->acceptedFileTypes(['application/pdf'])
                             ->maxSize(2048) 
                             ->disk('public') // <--- ΑΛΛΑΓΗ ΕΔΩ: από 'direct_public' σε 'public'
                             ->directory('uploads') // <--- Πρόσθεσε αυτό για να πηγαίνουν στον φάκελο uploads
                             ->preserveFilenames() 
                            ->columnSpan('full'),
                        
                        Forms\Components\TextInput::make('ai_score')->label('Βαθμολογία AI')->numeric(),
                        Forms\Components\Textarea::make('ai_analysis')->label('Ανάλυση AI'),
                        Forms\Components\Textarea::make('notes')->label('Σημειώσεις')->columnSpan('full'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ΥΠΟΨΗΦΙΟΣ')->searchable(),
                Tables\Columns\TextColumn::make('job.title')->label('ΘΕΣΗ'),
                Tables\Columns\BadgeColumn::make('status')->label('ΚΑΤΑΣΤΑΣΗ')
                    ->colors([
                        'primary' => 'new',
                        'warning' => 'interview',
                        'success' => 'hired',
                        'danger' => 'rejected',
                    ]),
                
                Tables\Columns\TextColumn::make('ai_score')
                    ->label('AI SCORE')
                    ->formatStateUsing(fn ($state) => $state ? "{$state}%" : '–')
                    ->fontFamily('mono')
                    ->color('success')
                    ->weight('bold'),
            ])
            ->filters([
                // Το φίλτρο για να βλέπεις όποια κατηγορία θέλεις
                Tables\Filters\SelectFilter::make('status')
                    ->label('Προβολή ανά Κατάσταση')
                    ->options([
                        'new' => 'Νέες Αιτήσεις',
                        'interview' => 'Συνεντεύξεις',
                        'hired' => 'Προσλήψεις',
                        'rejected' => 'Απορρίψεις',
                    ]),
            ])
            ->actions([
                // 1. Άνοιγμα CV
                Tables\Actions\Action::make('view_resume')
                    ->label('Άνοιγμα CV')
                    ->icon('heroicon-o-external-link')
                    ->url(fn ($record) => $record->resume_path ? asset('uploads/' . $record->resume_path) : null)
                    ->openUrlInNewTab() 
                    ->visible(fn ($record) => $record->resume_path !== null),

                // 2. Προβολή Ανάλυσης AI (Modal)
                Tables\Actions\Action::make('view_analysis')
                    ->label('Δες Ανάλυση')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->modalHeading(' Ανάλυση AI')
                    ->form([
                        Forms\Components\Textarea::make('ai_analysis')
                            ->disableLabel() 
                            ->default(fn ($record) => $record->ai_analysis)
                            ->disabled() 
                            ->rows(8)
                    ])
                    ->modalButton('Κλείσιμο') 
                    ->action(fn () => null)
                    ->visible(fn ($record) => $record->ai_analysis !== null), 

                // 3. Η εντολή Analyze (OpenAI)
                Tables\Actions\Action::make('analyze')
                    ->label('Analyze')
                    ->icon('heroicon-s-lightning-bolt')
                    ->color('warning')
                    ->action(function ($record) {
                        $filePath = public_path('uploads/' . $record->resume_path);
                        if (!file_exists($filePath)) return;

                        $parser = new Parser();
                        $pdf = $parser->parseFile($filePath);
                        $text = $pdf->getText();

                        $client = OpenAI::client(env('OPENAI_API_KEY'));
                        $result = $client->chat()->create([
                            'model' => 'gpt-3.5-turbo',
                            'messages' => [
                                ['role' => 'system', 'content' => 'You are an HR assistant. Return only JSON.'],
                                ['role' => 'user', 'content' => "Αξιολόγησε τον υποψήφιο για τη θέση: '{$record->job->title}'. Βιογραφικό: {$text}. JSON format: {\"score\": 85, \"analysis\": \"...\"}"]
                            ],
                        ]);

                        $data = json_decode($result->choices[0]->message->content, true);
                        if (isset($data['score'])) {
                            $record->update([
                                'ai_score' => $data['score'],
                                'ai_analysis' => $data['analysis']
                            ]);
                        }
                    }),
                
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}