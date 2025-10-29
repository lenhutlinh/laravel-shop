<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Trung tâm Hỗ trợ VieS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=4">
    <!-- FAQ JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {"@type":"Question","name":"Làm sao để đăng ký tài khoản trên VieS?","acceptedAnswer":{"@type":"Answer","text":"Bạn có thể đăng ký bằng email hoặc số điện thoại. Vào Trang Đăng Ký → nhập email/số điện thoại → làm theo hướng dẫn. Sau khi đăng ký, kiểm tra email/SMS để kích hoạt tài khoản."}},
        {"@type":"Question","name":"Quên mật khẩu, tôi phải làm sao?","acceptedAnswer":{"@type":"Answer","text":"Vào trang Đăng Nhập → chọn 'Quên mật khẩu' → làm theo hướng dẫn để đặt lại mật khẩu. Nếu vẫn gặp sự cố, liên hệ CSKH."}},
        {"@type":"Question","name":"Hệ thống chấp nhận những phương thức thanh toán nào?","acceptedAnswer":{"@type":"Answer","text":"Chúng tôi hỗ trợ COD, chuyển khoản, thẻ ATM/Internet Banking, thẻ tín dụng và ví điện tử (tùy shop)."}},
        {"@type":"Question","name":"Làm sao để đổi/trả hàng?","acceptedAnswer":{"@type":"Answer","text":"Vào Đơn hàng của tôi → chọn đơn cần đổi/trả → gửi yêu cầu đổi/trả theo hướng dẫn. Điều kiện đổi trả phụ thuộc vào chính sách shop."}},
        {"@type":"Question","name":"Bao lâu tôi nhận được tiền hoàn?","acceptedAnswer":{"@type":"Answer","text":"Thời gian hoàn tiền thường từ 3–10 ngày làm việc tùy ngân hàng hoặc phương thức thanh toán."}}
      ]
    }
    </script>
</head>
<body>
    @include('header')

    <main class="container py-5">
        <!-- Hero / Search -->
        <section class="support-hero mb-4 p-0 rounded shadow-sm bg-white overflow-hidden">
            <div class="row g-0 align-items-center">
                <div class="col-lg-7 p-4">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="icon-hero d-flex align-items-center justify-content-center rounded" style="width:84px;height:84px;background:linear-gradient(135deg,#0B3C5D,#FF8C00);color:#fff;font-size:28px;">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div>
                            <h1 class="mb-1" style="color:#0B3C5D">Xin chào — Trung tâm Hỗ trợ VieS</h1>
                            <p class="mb-2 text-muted">Bạn cần giúp đỡ điều gì hôm nay? Gõ câu hỏi bên dưới hoặc chọn chủ đề.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <input id="support-search" class="form-control form-control-lg" placeholder="Tìm kiếm: ví dụ 'hủy đơn', 'đổi trả', 'mã giảm giá'" aria-label="Tìm kiếm hỗ trợ">
                        <button class="btn btn-primary btn-lg" id="btn-search" style="background:linear-gradient(90deg,#0B3C5D,#FF8C00);border:0">Tìm câu trả lời</button>
                        <a href="#live-chat" class="btn btn-outline-secondary btn-lg">Bắt đầu trò chuyện</a>
                    </div>
                    <small class="text-muted d-block mt-2">Gợi ý: nhập mã đơn hàng hoặc mô tả ngắn để tìm nhanh.</small>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <!-- Hero image (Ảnh 1) -->
                    <img src="{{ asset('img/support1.jpg') }}" alt="Banner hỗ trợ VieS" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">
                </div>
            </div>
        </section>

        <div class="row g-4">
            <div class="col-lg-8">
                <!-- FAQ Accordion -->
                <section class="mb-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <h3 class="mb-0" style="color:#0B3C5D">Câu hỏi thường gặp (FAQ)</h3>
                        <!-- FAQ illustration (Ảnh 2) -->
                        <img src="{{ asset('img/support2.jpg') }}" alt="FAQ illustration" class="img-fluid d-none d-md-block" style="max-height:88px;object-fit:cover;border-radius:8px;">
                    </div>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">Làm sao để đăng ký tài khoản trên VieS?</button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Bạn có thể đăng ký bằng email hoặc số điện thoại. Vào Trang Đăng Ký → nhập email/số điện thoại → làm theo hướng dẫn và kích hoạt tài khoản.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">Quên mật khẩu, tôi phải làm sao?</button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Vào trang Đăng Nhập → chọn 'Quên mật khẩu' → nhập email/số điện thoại để nhận link hoặc mã đặt lại mật khẩu.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">Hệ thống chấp nhận những phương thức thanh toán nào?</button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">VieS hỗ trợ COD, chuyển khoản ngân hàng, thẻ, và ví điện tử (tùy shop). Vui lòng kiểm tra trang thanh toán để biết các phương thức cụ thể.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">Sản phẩm đã giao nhưng tôi chưa nhận — phải làm sao?</button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Kiểm tra trạng thái đơn trong tài khoản. Nếu ghi là 'Giao thành công' nhưng bạn chưa nhận, liên hệ Hotline hoặc Chat để VieS xác minh với đơn vị vận chuyển.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">Làm sao để đổi/trả hàng?</button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Vào Đơn hàng của tôi → chọn đơn → Yêu cầu đổi/trả và làm theo hướng dẫn hiển thị. Điều kiện đổi trả tùy shop và sản phẩm.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6">Bao lâu tôi nhận được tiền hoàn?</button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Sau khi yêu cầu được duyệt, thời gian hoàn tiền thường 3–10 ngày làm việc tùy ngân hàng hoặc phương thức thanh toán.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7">Mã giảm giá không áp dụng được?</button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="faq7" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Kiểm tra điều kiện mã (hạn dùng, áp dụng mặt hàng, giá trị tối thiểu). Nếu vẫn lỗi, chụp màn hình và gửi CSKH.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq8">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8">Tôi muốn khiếu nại merchant/đơn hàng thì sao?</button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="faq8" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Mở ticket trong trang Đơn hàng → chọn 'Khiếu nại' → mô tả chi tiết + đính kèm ảnh. CSKH sẽ xử lý và phản hồi.</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Help Articles -->
                <section class="mb-4">
                    <h3 style="color:#0B3C5D">Hướng dẫn nhanh</h3>
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        <div class="col"><a class="card h-100 text-decoration-none" href="#"><div class="card-body"><h5 class="card-title">Hướng dẫn mua hàng nhanh</h5><p class="card-text text-muted">Video 2 phút: từ tìm kiếm đến thanh toán.</p></div></a></div>
                        <div class="col"><a class="card h-100 text-decoration-none" href="#"><div class="card-body"><h5 class="card-title">Theo dõi đơn hàng</h5><p class="card-text text-muted">Cách kiểm tra trạng thái & vận đơn.</p></div></a></div>
                        <div class="col"><a class="card h-100 text-decoration-none" href="#"><div class="card-body"><h5 class="card-title">Đổi trả & hoàn tiền</h5><p class="card-text text-muted">Quy trình từng bước.</p></div></a></div>
                        <div class="col"><a class="card h-100 text-decoration-none" href="#"><div class="card-body"><h5 class="card-title">Mở shop trên VieS</h5><p class="card-text text-muted">Hướng dẫn dành cho người bán.</p></div></a></div>
                    </div>
                </section>

                <!-- Community / Forum preview -->
                <section class="mb-4">
                    <h3 style="color:#0B3C5D">Cộng đồng giải đáp (Forum)</h3>
                    <div class="card p-3">
                        <!-- Community illustration (Ảnh 3) -->
                        <div class="mb-3 d-flex justify-content-end">
                            <img src="{{ asset('img/support3.jpg') }}" alt="Cộng đồng VieS" class="img-fluid" style="max-height:120px;object-fit:cover;border-radius:8px;">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="mb-0">Trao đổi và hỏi đáp từ cộng đồng</h5>
                                <small class="text-muted">Tham gia để hỏi, trả lời và nhận mẹo mua sắm.</small>
                            </div>
                            <a class="btn btn-outline-primary" href="#">Đặt câu hỏi ngay</a>
                        </div>
                        <ul class="list-unstyled mb-0">
                            <li class="py-2 border-bottom"><a href="#">[Hot] Kinh nghiệm mua đồ điện tử giá tốt</a></li>
                            <li class="py-2 border-bottom"><a href="#">Lỗi khi áp mã giảm giá</a></li>
                            <li class="py-2 border-bottom"><a href="#">Shop nào giao nhanh khu vực HN?</a></li>
                        </ul>
                    </div>
                </section>
            </div>

            <aside class="col-lg-4">
                <div class="card mb-3 p-3 shadow-sm">
                    <h5 style="color:#0B3C5D">Hỗ trợ nhanh</h5>
                    <p class="mb-1"><strong>Hotline:</strong> <a href="tel:19001234">1900-1234</a> (8:00–22:00)</p>
                    <p class="mb-1"><strong>Email:</strong> <a href="mailto:support@vies.vn">support@vies.vn</a></p>
                    <p class="mb-0 text-muted">Ưu tiên chat/hotline cho vấn đề gấp.</p>
                </div>

                <div class="card mb-3 p-3 shadow-sm">
                    <h6>Kết nối nhanh</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#">Theo dõi đơn hàng</a></li>
                        <li><a href="#">Yêu cầu đổi trả</a></li>
                        <li><a href="#">Chính sách giao hàng</a></li>
                    </ul>
                </div>

                <div id="live-chat" class="card p-3 shadow-sm">
                    <h6>Chat trực tuyến</h6>
                    <p class="text-muted">Nhấp vào để bắt đầu chat với nhân viên VieS.</p>
                    <!-- Chat / Contact illustration (Ảnh 4) -->
                    <div class="mb-3 d-flex justify-content-center">
                        <img src="{{ asset('img/support4.png') }}" alt="Chat hỗ trợ" class="img-fluid" style="max-height:120px;object-fit:contain;">
                    </div>
                    <a class="btn btn-primary w-100" href="#">Bắt đầu trò chuyện</a>
                </div>
            </aside>
        </div>

        <!-- CTA -->
        <section class="mt-4 vies-cta">
            <div class="cta-inner p-4 rounded shadow-sm bg-white d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="cta-copy">
                    <h3 style="color:#0B3C5D">Cần thêm hỗ trợ?</h3>
                    <p class="mb-0 text-muted">Gọi ngay Hotline hoặc bắt đầu chat để được hỗ trợ nhanh.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="tel:19001234" class="btn vies-btn-outline me-2">Gọi ngay Hotline</a>
                    <a href="#live-chat" class="btn vies-btn-primary">Tạo yêu cầu/Chat ngay</a>
                </div>
            </div>
        </section>
    </main>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // simple JS: focus search with Enter and reveal animation
      document.addEventListener('DOMContentLoaded',function(){
        document.querySelectorAll('.reveal').forEach(function(el){
          var io = new IntersectionObserver(function(entries){ entries.forEach(function(e){ if(e.isIntersecting){ e.target.classList.add('in-view'); io.unobserve(e.target); } }); }, {threshold:.12});
          io.observe(el);
        });
        var s = document.getElementById('support-search'); if(s){ s.addEventListener('keydown', function(e){ if(e.key==='Enter'){ e.preventDefault(); document.getElementById('btn-search').click(); } }); }
      });
    </script>
</body>
</html>
