<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=3">
    <!-- Inline critical styles for About page (cache-bypass) -->
    <style>
    :root{ --vies-primary:#0B3C5D; --vies-accent:#FF8C00; --vies-text:#12393e; }
    .vies-section{ padding:44px 0; }
    .vies-container{ max-width:1200px; margin:0 auto; padding:0 20px; }
    .reveal{ opacity:0; transform: translateY(18px); transition: all .6s cubic-bezier(.2,.9,.2,1); }
    .reveal.in-view{ opacity:1; transform:none; }
    .vies-overview .overview-inner{ display:flex; gap:20px; align-items:center; background: linear-gradient(180deg, rgba(11,60,93,0.03), rgba(255,140,0,0.02)); padding:20px; border-radius:12px; }
    .overview-media{ width:80px; height:80px; display:flex; align-items:center; justify-content:center; color:#fff; background: linear-gradient(135deg,var(--vies-primary), var(--vies-accent)); border-radius:12px; }
    .vies-h2{ margin:0 0 6px 0; font-size:24px; color:var(--vies-primary); }
    .vies-lead{ margin:0; color:var(--vies-text); line-height:1.6; }
    .values-grid, .team-grid{ display:grid; gap:18px; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); }
    .value-card{ background: linear-gradient(180deg,#fff,#f7fdff); padding:16px; border-radius:12px; text-align:center; box-shadow:0 8px 26px rgba(11,60,93,0.04); border-left:4px solid rgba(11,60,93,0.06); transition: transform .28s ease; }
    .value-card:hover{ transform:translateY(-6px); }
    .value-icon{ width:56px; height:56px; margin:0 auto 10px; display:flex; align-items:center; justify-content:center; color:#fff; background: linear-gradient(90deg,var(--vies-primary), var(--vies-accent)); border-radius:10px; }
    .team-card{ display:flex; flex-direction:column; align-items:center; padding:14px; background: linear-gradient(180deg,#fff,#eef9fb); border-radius:12px; }
    .team-card img{ width:96px; height:96px; object-fit:cover; border-radius:50%; border:4px solid rgba(255,255,255,0.7); }
    .vies-cta .cta-inner{ display:flex; gap:16px; align-items:center; justify-content:space-between; background: linear-gradient(90deg, rgba(11,60,93,0.04), rgba(255,140,0,0.02)); padding:18px; border-radius:12px; }
    .vies-btn-primary{ background: linear-gradient(90deg,var(--vies-primary), var(--vies-accent)); color:#fff; padding:10px 16px; border-radius:8px; text-decoration:none; display:inline-block; }
    @media(max-width:880px){ .vies-overview .overview-inner{ flex-direction:column; text-align:center } .vies-cta .cta-inner{ flex-direction:column; } }
    </style>
    <title>Về VieS</title>
</head>
<body>
    @include('header')

    <main>
        <div class="about-hero">
            <div class="about-hero-inner">
                <img src="{{ asset('img/about3.jpg') }}" alt="VieS banner">
            </div>
        </div>

        {{-- Intro box moved below hero so it doesn't overlay the image --}}
        <div class="container-inner container" style="margin-top:24px;">
            <div class="about-intro-box">
                <div class="accent-line"></div>
                <h1 class="about-title">Về VieS</h1>
                <p class="about-subtitle">VieS - Nền tảng thương mại điện tử uy tín, chất lượng, mang đến trải nghiệm mua sắm trực tuyến an toàn và tiện lợi cho hàng triệu khách hàng.</p>
                <div class="about-actions" style="margin-top:12px;">
                    <a href="{{ route('registers') }}" class="btn-primary-custom">Tạo tài khoản</a>
                    <a href="{{ route('register_shop') }}" class="btn-outline-custom" style="margin-left:10px;">Mở shop</a>
                </div>
            </div>
        </div>

        <section class="about-features container-inner">
            <div class="features-grid">
                <article class="feature-item about-card">
                    <div class="feature-icon"><i class="fas fa-bullseye"></i></div>
                    <h4>Sứ mệnh</h4>
                    <p>Giúp người mua tiếp cận sản phẩm chất lượng với giá hợp lý; hỗ trợ người bán xây dựng thương hiệu và phát triển kinh doanh trực tuyến.</p>
                </article>
                <article class="feature-item about-card">
                    <div class="feature-icon"><i class="fas fa-hand-holding-heart"></i></div>
                    <h4>Giá trị cốt lõi</h4>
                    <ul>
                        <li>An toàn &amp; Minh bạch</li>
                        <li>Chất lượng &amp; Đa dạng</li>
                        <li>Hỗ trợ người bán</li>
                    </ul>
                </article>
                <article class="feature-item about-card">
                    <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                    <h4>Dịch vụ nổi bật</h4>
                    <p>Giao hàng nhanh, thanh toán an toàn, hệ thống hoàn trả và chăm sóc khách hàng 24/7.</p>
                </article>
            </div>
        </section>

        <section class="about-why container-inner">
            <h2 class="section-title"><i class="fas fa-star-of-life"></i> Tại sao chọn VieS?</h2>
            <div class="why-grid">
                <div class="why-item about-card">
                    <h4>Hàng chính hãng</h4>
                    <p>Sản phẩm được kiểm duyệt kỹ lưỡng trước khi đăng bán.</p>
                </div>
                <div class="why-item about-card">
                    <h4>Bảo mật thanh toán</h4>
                    <p>Hỗ trợ nhiều phương thức thanh toán an toàn.</p>
                </div>
                <div class="why-item about-card">
                    <h4>Hỗ trợ người bán</h4>
                    <p>Công cụ quản lý shop, báo cáo doanh số, quảng cáo tiếp thị.</p>
                </div>
            </div>
        </section>

        <!-- Removed center CTA as requested -->

        <section class="team-section container-inner">
            <h2 class="section-title">Đội ngũ của chúng tôi</h2>
            <div class="team-grid">
                <div class="team-card">
                    <img src="{{ asset('img/daidien1.jpg') }}" alt="Lê Nhựt Linh">
                    <strong>Lê Nhựt Linh</strong>
                    <div>Founder &amp; CEO</div>
                </div>
                <div class="team-card">
                    <img src="{{ asset('img/team2.jpg') }}" alt="Châu Hoàng Việt">
                    <strong>Châu Hoàng Việt</strong>
                    <div>CTO</div>
                </div>
                <div class="team-card">
                    <img src="{{ asset('img/team3.jpg') }}" alt="Nguyễn Vũ Kha">
                    <strong>Nguyễn Vũ Kha</strong>
                    <div>Head of Product</div>
                </div>
            </div>
        </section>
    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        <script>
            // small intersection observer to add .in-view for reveal animations
            (function(){
                const io = new IntersectionObserver((entries)=>{
                    entries.forEach(e=>{
                        if(e.isIntersecting){ e.target.classList.add('in-view'); io.unobserve(e.target); }
                    });
                }, {threshold:0.12});
                document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
            })();
        </script>
</body>
</html>
