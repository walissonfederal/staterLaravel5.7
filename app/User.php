<?php

namespace LaraDev;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'genre',
        'document',
        'document_secondary',
        'document_secondary_complement',
        'date_of_birth',
        'place_of_birth',
        'civil_status',
        'cover',
        'occupation',
        'income',
        'company_work',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'telephone',
        'cell',
        'type_of_communion',
        'spouse_name',
        'spouse_genre',
        'spouse_document',
        'spouse_document_secondary',
        'spouse_document_secondary_complement',
        'spouse_date_of_birth',
        'spouse_place_of_birth',
        'spouse_occupation',
        'spouse_income',
        'spouse_company_work',
        'lessor',
        'lessee',
        'admin',
        'client',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setLessorAttribute($value)
    {
        $this->attributes['lessor'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setLesseeAttribute($value)
    {
        $this->attributes['lessee'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setAdminAttribute($value)
    {
        $this->attributes['admin'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = $this->clearField($value);
    }

    public function getDocumentAttribute($value)
    {
        return substr($value,0,3).'.'.substr($value,3,3).'.'.substr($value,6,3).'-'.substr($value,9,2);
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = @date_fmt_db($value);
    }

    public function getDateOfBirthAttribute($value)
    {
        return @date_fmt_br($value);
    }

    public function setIncomeAttribute($value)
    {
        $this->attributes['income'] = @str_to_float($value);
    }

    public function getIncomeAttribute($value)
    {
        return @float_to_str($value);
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = @str_to_number($value);
    }

    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = @str_to_number($value);
    }

    public function setCellAttribute($value)
    {
        $this->attributes['cell'] = @str_to_number($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setSpouseDocumentAttribute($value)
    {
        $this->attributes['spouse_document'] = @str_to_number($value);
    }

    public function getSpouseDocumentAttribute($value)
    {
        return substr($value,0,3).'.'.substr($value,3,3).'.'.substr($value,6,3).'-'.substr($value,9,2);
    }

    public function setSpouseDateOfBirthAttribute($value)
    {
        $this->attributes['spouse_date_of_birth'] = @date_fmt_db($value);
    }

    public function getSpouseDateOfBirthAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function setSpouseIncomeAttribute($value)
    {
        $this->attributes['spouse_income'] = @str_to_float($value);
    }

    public function getSpouseIncomeAttribute($value)
    {
        return @float_to_str($value);
    }

    private function convertStringToFloat(?string $param)
    {
        if (empty($param)){
            return null;
        }
        return str_replace(['.',','], ['','.'], $param);
    }

    private function clearField(?string $param)
    {
        if (empty($param)){
            return '';
        }
        return str_replace(['.','-', '/', '(', ')', ' '], '', $param);
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)){
            return null;
        }
        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year.'-'.$month.'-'.$day))->format('Y-m-d');
    }
}
