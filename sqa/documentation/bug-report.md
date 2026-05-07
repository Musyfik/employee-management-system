# Employee Management System - Bug Report

| Bug ID | Module | Severity | Priority | Summary | Status |
|--------|--------|----------|----------|---------|--------|
| BUG001 | Employee Create | High | High | Employee gagal ditambahkan saat submit form | Open |
| BUG002 | Photo Upload | Medium | Medium | Upload foto employee gagal dilakukan | Open |

---

# BUG001 - Employee gagal ditambahkan

## Steps to Reproduce
1. Login ke sistem
2. Buka menu employee
3. Klik create employee
4. Isi semua field
5. Klik submit

## Expected Result
Employee berhasil ditambahkan ke database.

## Actual Result
Employee gagal ditambahkan dan data tidak tersimpan.

## Severity
High

## Priority
High

## Status: Closed

Resolution:
Issue terjadi karena file WEBP hanya diganti extension menjadi JPG tanpa konversi format asli. Sistem berhasil memvalidasi mime type image dengan benar.

---

# BUG002 - Upload foto gagal

## Steps to Reproduce
1. Login ke sistem
2. Buka create employee
3. Upload file gambar
4. Klik submit

## Expected Result
Foto berhasil diupload dan tampil di employee.

## Actual Result
Foto gagal diupload.

## Severity
Medium

## Priority
Medium

## Status: Closed

Resolution:
Issue terjadi karena file WEBP hanya diganti extension menjadi JPG tanpa konversi format asli. Sistem berhasil memvalidasi mime type image dengan benar.