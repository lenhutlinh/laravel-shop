# 🚀 HƯỚNG DẪN DEPLOY LARAVEL LÊN RAILWAY

## ✅ ĐÃ HOÀN THÀNH:
- [x] Tạo Git repository
- [x] Push code lên GitHub: https://github.com/lenhutlinh/laravel-shop

---

## 📋 CÁC BƯỚC TIẾP THEO:

### BƯỚC 1: Đăng ký Railway
1. Truy cập: https://railway.app/
2. Click "Start a New Project"
3. Đăng nhập bằng GitHub
4. Authorize Railway

### BƯỚC 2: Deploy từ GitHub
1. Click "Deploy from GitHub repo"
2. Chọn repository: lenhutlinh/laravel-shop
3. Railway sẽ tự động detect Laravel

### BƯỚC 3: Add MySQL Database
1. Click "New" → "Database" → "Add MySQL"
2. Railway sẽ tự tạo database

### BƯỚC 4: Configure Environment Variables
Thêm các biến môi trường:
```
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:lxr18fs2Ipx0lN4FrogePM6AA81aPw/nVtf7fPzU2FE=
APP_DEBUG=false
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}

DB_CONNECTION=mysql
DB_HOST=${{MYSQL_HOST}}
DB_PORT=${{MYSQL_PORT}}
DB_DATABASE=${{MYSQL_DATABASE}}
DB_USERNAME=${{MYSQL_USER}}
DB_PASSWORD=${{MYSQL_PASSWORD}}

# Railway sẽ tự động inject các biến MYSQL_*
```

### BƯỚC 5: Run Migrations
Trong Railway Dashboard:
1. Settings → Add custom start command
2. Command: `php artisan migrate --force`

### BƯỚC 6: Generate Domain
1. Settings → Generate Domain
2. Railway sẽ tạo domain: your-app.up.railway.app

---

## 🎯 LỢI ÍCH RAILWAY:
✅ Deploy tự động khi push code
✅ Free $5 credit/tháng
✅ MySQL/PostgreSQL miễn phí
✅ HTTPS tự động
✅ Zero downtime deployment
✅ Environment variables
✅ Custom domains
✅ Logs real-time

---

## 📝 GHI CHÚ:
- Railway free plan: 500 hours/month
- Đủ cho development/testing
- Upgrade nếu cần production

