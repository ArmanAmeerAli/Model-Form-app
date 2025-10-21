<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Models\Employee;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->label('First Name')
                    ->required()
                    ->minLength(2)
                    ->maxLength(50),
                TextInput::make('last_name')
                    ->label('Last Name')
                    ->required()
                    ->minLength(2)
                    ->maxLength(50),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->unique(Employee::class, 'email', ignoreRecord: true) //current record is excluded when checking for uniqueness
                    ->maxLength(150)
                    ->email(),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->required()
                    ->tel()
                    ->unique(Employee::class, 'phone', ignoreRecord: true)
                    ->rules(['required', 'digits:10', 'numeric']) // phone number must be 11 digits and numeric
                    ->helpertext('Enter a 10-Digit Phone number(numbers only, no spaces, no special characters)')
                    ->validationAttribute('Phone Number'), //Validation attribute method to change the default validation for the phone field
                TextInput::make('position')
                    ->label('Job Title')
                    ->required()
                    ->minLength(4)
                    ->maxLength(150),
                TextInput::make('salary')
                    ->label('Salary')
                    ->required()
                    ->numeric() //This enforce the input can only be a numerical value
                    ->minValue(100)
                    ->maxValue(99999999.99)
                    ->step(0.01) //input allow upto 2 decimal places
                    ->placeholder('5000.00')
                    ->helperText('Enter a Salary between 100.00 and 99999999.99!')
            ]);
    }
}
