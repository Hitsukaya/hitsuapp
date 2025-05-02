<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Modules\Blog\Entities\BlogPost;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ROLE_ADMIN = 'ADMIN';

    const ROLE_EDITOR = 'EDITOR';

    const ROLE_MEMBERSHIP = 'MEMBERSHIP';

    const ROLE_USER = 'USER';

    const DEFAULT_USER = self::ROLE_USER;

    const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_EDITOR => "Editor",
        self::ROLE_MEMBERSHIP => "Membership",
        self::ROLE_USER => "User",
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->can('view-admin', User::class);
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isEditor()
    {
        return $this->role === self::ROLE_EDITOR;
    }

    public function isMembership()
    {
        return $this->role === self::ROLE_MEMBERSHIP;
    }

    public function isAdminOrEditor()
    {
    return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_EDITOR]);
    }


    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'online_at',
        'bio',
        'last_login_at',
        'login_count',
    ];

    /**
     * The attribute online_at
    */
    public function getIsOnlineAttribute()
    {
    return $this->online_at && $this->online_at->gt(now()->subMinutes(5));
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }


    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function scopeOnline($query)
    {
    return $query->where('online_at', '>=', now()->subMinutes(5));
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'online_at' => 'datetime',
        ];
    }

    public static function getForm()
    {
        return [
            Section::make('Account')
                ->schema([
                    Fieldset::make('User Informations')->schema([
                        Fieldset::make('User Informations')
                        ->schema([
                        FileUpload::make('avatar')->image()->directory('profile-photos')
                            ->avatar(),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('password') //Change Name or Email or Role but password not change
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->maxLength(255),
                        ])->columns(3),
                        Textarea::make('two_factor_secret')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Textarea::make('two_factor_recovery_codes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        DateTimePicker::make('two_factor_confirmed_at'),
                        Select::make('role')
                            ->options(User::ROLES)
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        DateTimePicker::make('email_verified_at'),
                    ]),
                ]),
        ];
    }

}
