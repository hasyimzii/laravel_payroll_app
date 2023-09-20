# Presence API Docs

## Get Employees
Endpoint: GET /api/employee

Response Success (200) :
```json
{
    "data": [
        {
            "name": "Mamat Surahmat",
            "birth_place": "Jember",
            "birth_date": "1998-10-11",
            "gender": "male",
            "position": "Staff Web Developer",
            "status": "fulltime",
            "basic_salary": 5000000,
            "allowance": 2000000,
            "start_date": "2021-09-01"
        }
    ]
}
```

## Create Presence
Endpoint: POST /api/presence

Request Body :
```json
{
    "employee_id": 1
}
```

Response Success (200) :
```json
{
    "message": "Berhasil melakukan presensi!"
}
```

Response Error (400) :
```json
{
    "message": "Karyawan sudah melakukan presensi hari ini!"
}
```


Response Error (404) :
```json
{
    "message": "Data karyawan tidak ditemukan!"
}
```