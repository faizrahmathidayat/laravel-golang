package entity

type Customer struct {
    CstId        int    `json:"cst_id" gorm:"primary_key"`
    NationalityId int `json:"nationality_id"`
    // Nationality *Nationality `gorm:"foreignKey:nationality_id;references:nationality_id"`
    CstName  string `json:"nama"`
    CstDob     string `json:"tanggal_lahir"`
    CstPhoneNum     string `json:"telepon"`
    CstEmail     string `json:"email"`
    FamilyList     []FamilyList `gorm:"foreignkey:CstId"`
}

type FamilyList struct {
    FlId        int    `json:"fl_id" gorm:"primary_key"`
    CstId int `json:"cst_id"`
    FlRelation  string `json:"hubungan"`
    FlName  string `json:"nama"`
    FlDob  string `json:"tanggal_lahir"`
}

type Nationality struct {
    NationalityId        int    `json:"nationality_id" gorm:"primary_key"`
    NationalityName string `json:"nationality_name"`
    NationalityCode  string `json:"nationality_code"`
}