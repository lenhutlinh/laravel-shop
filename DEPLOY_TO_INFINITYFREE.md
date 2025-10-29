# 🚀 HƯỚNG DẪN DEPLOY LÊN INFINITYFREE

## Bước 1: Đăng ký tài khoản InfinityFree

1. Truy cập: https://www.infinityfree.com/
2. Click "Register" → Tạo tài khoản mới
3. Xác nhận email

## Bước 2: Tạo hosting account

1. Login vào InfinityFree
2. Click "Create Account"
3. Chọn domain (subdomain miễn phí hoặc domain riêng)
4. Chờ account được tạo (1-5 phút)

## Bước 3: Tạo Database trên InfinityFree

1. Vào Control Panel → MySQL Databases
2. Click "Create Database"
3. Lưu lại thông tin:
   - Database Name: `epiz_XXXXXXX_dbname`
   - Username: `epiz_XXXXXXX`
   - Password: `********`
   - Hostname: `sqlXXX.infinityfree.com`

## Bước 4: Chuẩn bị file upload

### 4.1. Tạo file .env
```bash
# Copy file .env.production thành .env
cp .env.production .env
```

### 4.2. Sửa thông tin database trong .env
```env
DB_HOST=sqlXXX.infinityfree.com
DB_DATABASE=epiz_XXXXXXX_dbname
DB_USERNAME=epiz_XXXXXXX
DB_PASSWORD=your_password_here
APP_URL=http://yourdomain.infinityfreeapp.com
```

### 4.3. Tạo APP_KEY
```bash
php artisan key:generate
```

### 4.4. Nén các file cần upload
Nén các folder/file sau thành file ZIP:
- ✅ app/
- ✅ bootstrap/
- ✅ config/
- ✅ database/
- ✅ lang/
- ✅ public/
- ✅ resources/
- ✅ routes/
- ✅ storage/
- ✅ vendor/
- ✅ .htaccess (file mới tạo ở root)
- ✅ .env (file vừa config)
- ✅ artisan
- ✅ composer.json
- ✅ composer.lock

**KHÔNG NÉN:**
- ❌ node_modules/
- ❌ tests/
- ❌ .git/
- ❌ *.md files
- ❌ thuongmaidientu.sql

## Bước 5: Upload file lên InfinityFree

### Cách 1: FTP (FileZilla)
1. Tải FileZilla: https://filezilla-project.org/
2. Kết nối FTP với thông tin từ InfinityFree:
   - Host: `ftpupload.net`
   - Username: `epiz_XXXXXXX`
   - Password: (mật khẩu account)
   - Port: 21

3. Upload file ZIP vào folder `htdocs/`
4. Dùng File Manager trên InfinityFree để giải nén

### Cách 2: File Manager (khuyên dùng cho file nhỏ)
1. Vào Control Panel → Online File Manager
2. Vào folder `htdocs/`
3. Upload file ZIP
4. Click chuột phải → Extract

## Bước 6: Import Database

### 6.1. Export database từ local
```bash
# Trên XAMPP, vào phpMyAdmin
# Export database: thuongmaidientu → Export → SQL → Go
```

### 6.2. Import vào InfinityFree
1. Control Panel → phpMyAdmin
2. Chọn database vừa tạo
3. Tab "Import"
4. Choose file → chọn file .sql
5. Click "Go"

**⚠️ LƯU Ý:** InfinityFree giới hạn file upload 10MB
- Nếu file SQL > 10MB, chia nhỏ hoặc dùng BigDump

## Bước 7: Set permissions cho folder storage

1. Vào File Manager
2. Chuột phải folder `storage/` → Change Permissions
3. Set: 755 hoặc 775
4. Check "Recurse into subdirectories"
5. Apply

Làm tương tự với `bootstrap/cache/`

## Bước 8: Kiểm tra website

1. Truy cập: `http://yourdomain.infinityfreeapp.com`
2. Kiểm tra các chức năng:
   - ✅ Đăng nhập/Đăng ký
   - ✅ Hiển thị sản phẩm
   - ✅ Giỏ hàng
   - ✅ Thanh toán
   - ✅ Admin panel

## ⚠️ CÁC VẤN ĐỀ THƯỜNG GẶP

### 1. Lỗi 500 Internal Server Error
- Kiểm tra file .env có đúng không
- Kiểm tra permissions của storage/ và bootstrap/cache/
- Check log tại: storage/logs/laravel.log

### 2. Database connection failed
- Kiểm tra lại thông tin DB trong .env
- Đảm bảo đã import database
- Kiểm tra user có quyền truy cập database

### 3. CSS/JS không load
- Kiểm tra APP_URL trong .env
- Chạy: `php artisan config:cache`
- Clear cache browser

### 4. Lỗi "419 Page Expired"
- Clear session: `php artisan session:clear`
- Check APP_KEY đã generate chưa

### 5. Images không hiển thị
- Check folder storage/app/public có ảnh không
- Tạo symlink: `php artisan storage:link`

## 🔧 OPTIMIZE CHO PRODUCTION

```bash
# Sau khi upload, chạy các lệnh sau qua SSH/Terminal:
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

**⚠️ LƯU Ý:** InfinityFree FREE không có SSH access
- Cần upgrade lên Premium nếu cần SSH
- Hoặc chạy các lệnh này trên local trước khi upload

## 📝 CHECKLIST TRƯỚC KHI GO-LIVE

- [ ] File .env đã config đúng
- [ ] Database đã import
- [ ] APP_KEY đã generate
- [ ] Storage permissions đã set
- [ ] APP_DEBUG=false trong .env
- [ ] APP_ENV=production
- [ ] Test tất cả chức năng
- [ ] Backup code và database

## 🎉 HOÀN THÀNH!

Website của bạn đã online tại: http://yourdomain.infinityfreeapp.com

---

**Hỗ trợ:**
- InfinityFree Forum: https://forum.infinityfree.com/
- Laravel Documentation: https://laravel.com/docs


