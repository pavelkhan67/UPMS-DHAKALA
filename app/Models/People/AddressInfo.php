<?php

namespace App\Models\People;

use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\House;
use App\Models\Road;
use App\Models\Thana;
use App\Models\Union;
use App\Models\UnionWard;
use App\Models\VillageArea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'address_infos';
    protected $fillable = ['user_id',
    'permanent_division_id',
    'permanent_district_id',
    'permanent_thana_id',
    'permanent_union_id',
    'permanent_ward_id',
    'permanent_village_id',
    'permanent_village_area_id',
    'permanent_road',
    'permanent_house',
    'permanent_flat',
    'permanent_area',
    'permanent_area_bn',
    'present_division_id',
    'present_district_id',
    'present_thana_id',
    'present_union_id',
    'present_ward_id',
    'present_village_id',
    'present_village_area_id',
    'present_road',
    'present_house',
    'present_area',
    'present_area_bn',
    'present_flat',
    'present_start_date'
    ];

    public function presentUnion()
    {
        return $this->belongsTo(Union::class, 'present_union_id', 'id');
    }

    public function presentRoad()
    {
        return $this->belongsTo(Road::class, 'present_road', 'id');
    }

    public function permanentRoad()
    {
        return $this->belongsTo(Road::class, 'permanent_road', 'id');
    }

    public function presentThana()
    {
        return $this->belongsTo(Thana::class, 'present_thana_id', 'id');
    }

    public function presentDistrict()
    {
        return $this->belongsTo(District::class, 'present_district_id', 'id');
    }

    public function permanentVillage()
    {
        return $this->belongsTo(Village::class, 'permanent_village_id', 'id');
    }

    public function presentVillage()
    {
        return $this->belongsTo(Village::class, 'present_village_id', 'id');
    }

    public function permanentWard()
    {
        return $this->belongsTo(UnionWard::class, 'permanent_ward_id', 'id');

    }

    public function presentWard()
    {
        return $this->belongsTo(UnionWard::class, 'present_ward_id', 'id');
    }

    public function permanentHouse()
    {
        return $this->belongsTo(House::class, 'permanent_house', 'id');
    }

    public function presentHouse()
    {
        return $this->belongsTo(House::class, 'present_house', 'id');
    }

    public function presentArea()
    {
        return $this->belongsTo(VillageArea::class, 'present_village_area_id', 'id');
    }
    public function permanentArea()
    {
        return $this->belongsTo(VillageArea::class, 'permanent_village_area_id', 'id');
    }
}
