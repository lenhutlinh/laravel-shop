# ⚡ HƯỚNG DẪN NHANH - UPLOAD LÊN INFINITYFREE

## 🎯 CÁC BƯỚC NGẮN GỌN:

### 1️⃣ Tạo file .env
```bash
# Copy file ENV_TEMPLATE_FOR_INFINITYFREE.txt thành .env
copy ENV_TEMPLATE_FOR_INFINITYFREE.txt .env
```

### 2️⃣ Generate APP_KEY
```bash
php artisan key:generate
```

### 3️⃣ Nén các file để upload
**NÉN CÁC FOLDER/FILE SAU:**
```
✅ app/
✅ bootstrap/
✅ config/
✅ database/
✅ lang/
✅ public/
✅ resources/
✅ routes/
✅ storage/
✅ vendor/
✅ .htaccess
✅ .env
✅ artisan
✅ composer.json
✅ composer.lock
```

**KHÔNG NÉN:**
```
❌ node_modules/
❌ tests/
❌ chatbot_data/
❌ .git/
❌ *.md (các file hướng dẫn)
❌ thuongmaidientu.sql
❌ package.json, package-lock.json
❌ vite.config.js, tailwind.config.js, postcss.config.js
```

### 4️⃣ Upload lên InfinityFree
1. Đăng ký tài khoản: https://www.infinityfree.com/
2. Tạo hosting account
3. Upload file ZIP vào folder `htdocs/`
4. Giải nén trên File Manager

### 5️⃣ Tạo và Import Database
1. Control Panel → MySQL Databases → Create Database
2. Lưu thông tin: Host, Database, Username, Password
3. phpMyAdmin → Import file `thuongmaidientu.sql`

### 6️⃣ Cập nhật .env trên server
Sửa file .env trên InfinityFree:
```env
DB_HOST=sqlXXX.infinityfree.com
DB_DATABASE=epiz_XXXXXXX_dbname
DB_USERNAME=epiz_XXXXXXX
DB_PASSWORD=your_password
APP_URL=http://yourdomain.infinityfreeapp.com
```

### 7️⃣ Set Permissions
```
storage/ → 755
bootstrap/cache/ → 755
```

### 8️⃣ Kiểm tra Website
Truy cập: `http://yourdomain.infinityfreeapp.com`

---

## 📌 GHI CHÚ QUAN TRỌNG:

1. **File .htaccess** đã được tạo sẵn ở root → redirect vào `public/`
2. **File ENV_TEMPLATE_FOR_INFINITYFREE.txt** → template cho .env
3. **Giới hạn InfinityFree Free:**
   - 5GB dung lượng
   - 10MB file upload (phpMyAdmin)
   - Không có SSH access
   - Hit limits: 50,000 hits/day

4. **Nếu file SQL > 10MB:**
   - Dùng BigDump: http://www.ozerov.de/bigdump/
   - Hoặc chia nhỏ file SQL

---

Xem hướng dẫn chi tiết tại: `DEPLOY_TO_INFINITYFREE.md`


