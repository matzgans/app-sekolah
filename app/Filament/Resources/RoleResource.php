<?php

namespace App\Filament\Resources; // Namespace diubah ke App

// Import Resource dasar Filament
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Facades\Filament;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

// Import class-class dari Plugin Vendor (Penting agar Pages & Relation tetap jalan)
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\Pages\CreateRole;
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\Pages\EditRole;
// use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\Pages\ListRoles;
use App\Filament\Resources\RoleResource\Pages\ListRoles;
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\Pages\ViewRole;
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\RelationManager\PermissionRelationManager;
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\RelationManager\UserRelationManager;

class RoleResource extends Resource
{

    protected static ?string $navigationLabel = 'Role';

    public static function getNavigationLabel(): string
    {
        return 'Role';
    }
    // Bagian ini mengambil setting dari config plugin
    public static function isScopedToTenant(): bool
    {
        return config('filament-spatie-roles-permissions.scope_roles_to_tenant', config('filament-spatie-roles-permissions.scope_to_tenant', true));
    }

    public static function getNavigationIcon(): ?string
    {
        return config('filament-spatie-roles-permissions.icons.role_navigation');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return config('filament-spatie-roles-permissions.should_register_on_navigation.roles', true);
    }

    public static function getModel(): string
    {
        return config('permission.models.role', Role::class);
    }

    public static function getLabel(): string
    {
        // return __('filament-spatie-roles-permissions::filament-spatie.section.role');
        return 'Role';
    }

    public static function getNavigationGroup(): ?string
    {
        return __(config('filament-spatie-roles-permissions.navigation_section_group', 'filament-spatie-roles-permissions::filament-spatie.section.roles_and_permissions'));
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-spatie-roles-permissions.sort.role_navigation');
    }

    public static function getPluralLabel(): string
    {
        // return __('filament-spatie-roles-permissions::filament-spatie.section.roles');
        return 'Role';
    }

    public static function getCluster(): ?string
    {
        return config('filament-spatie-roles-permissions.clusters.roles', null);
    }

    // --- ANDA BISA MENGUBAH FORM DI SINI ---
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                                    ->required()
                                    ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule) {
                                        if (config('permission.teams', false) && Filament::hasTenancy()) {
                                            $rule->where(config('permission.column_names.team_foreign_key', 'team_id'), Filament::getTenant()->id);
                                        }
                                        return $rule;
                                    }),

                                Select::make('guard_name')
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name'))
                                    ->options(config('filament-spatie-roles-permissions.guard_names'))
                                    ->default(config('filament-spatie-roles-permissions.default_guard_name'))
                                    ->visible(fn() => config('filament-spatie-roles-permissions.should_show_guard', true))
                                    ->required(),

                                Select::make('permissions')
                                    ->columnSpanFull()
                                    ->multiple()
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.permissions'))
                                    ->relationship(
                                        name: 'permissions',
                                        modifyQueryUsing: fn(Builder $query) => $query->orderBy('name'),
                                    )
                                    ->visible(config('filament-spatie-roles-permissions.should_show_permissions_for_roles'))
                                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name} ({$record->guard_name})")
                                    ->searchable(['name', 'guard_name'])
                                    ->preload(config('filament-spatie-roles-permissions.preload_permissions')),

                                Select::make(config('permission.column_names.team_foreign_key', 'team_id'))
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.team'))
                                    ->hidden(fn() => ! config('permission.teams', false) || Filament::hasTenancy())
                                    ->options(fn() => config('filament-spatie-roles-permissions.team_model', App\Models\Team::class)::pluck('name', 'id'))
                                    ->dehydrated(fn($state) => (int) $state > 0)
                                    ->placeholder(__('filament-spatie-roles-permissions::filament-spatie.select-team'))
                                    ->hint(__('filament-spatie-roles-permissions::filament-spatie.select-team-hint')),
                            ]),
                    ]),
            ]);
    }

    // --- ANDA BISA MENGUBAH TABLE DI SINI ---
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                    ->searchable(),
                TextColumn::make('permissions_count')
                    ->counts('permissions')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.permissions_count'))
                    ->toggleable(isToggledHiddenByDefault: config('filament-spatie-roles-permissions.toggleable_guard_names.roles.isToggledHiddenByDefault', true)),
                TextColumn::make('guard_name')
                    ->toggleable(isToggledHiddenByDefault: config('filament-spatie-roles-permissions.toggleable_guard_names.roles.isToggledHiddenByDefault', true))
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name'))
                    ->searchable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions(
                config('filament-spatie-roles-permissions.should_remove_empty_state_actions.roles') ? [] :
                    [Tables\Actions\CreateAction::make()]
            );
    }

    public static function getRelations(): array
    {
        $relationManagers = [];
        if (config('filament-spatie-roles-permissions.should_display_relation_managers.permissions', true)) {
            $relationManagers[] = PermissionRelationManager::class;
        }
        if (config('filament-spatie-roles-permissions.should_display_relation_managers.users', true)) {
            $relationManagers[] = UserRelationManager::class;
        }
        return $relationManagers;
    }

    public static function getPages(): array
    {
        if (config('filament-spatie-roles-permissions.should_use_simple_modal_resource.roles')) {
            return [
                'index' => ListRoles::route('/'),
            ];
        }

        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
            'view' => ViewRole::route('/{record}'),
        ];
    }
}
