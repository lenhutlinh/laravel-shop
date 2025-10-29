============================================
HƯỚNG DẪN SỬ DỤNG DỮ LIỆU HUẤN LUYỆN CHATBOT
VieS E-Commerce - Laravel System
============================================

📌 GIỚI THIỆU

Bộ dữ liệu này được tạo tự động từ mã nguồn Laravel của dự án VieS - nền tảng thương mại điện tử.
Mục đích: Huấn luyện chatbot thông minh, hiểu ngôn ngữ tự nhiên tiếng Việt, trả lời câu hỏi khách hàng về:
- Sản phẩm, giá cả, khuyến mãi
- Đặt hàng, thanh toán, giao hàng
- Tài khoản, bảo mật
- Chính sách đổi trả, bảo hành
- Hỗ trợ khách hàng

============================================

📁 CẤU TRÚC THỦ MỤC

/chatbot_data/
│
├── training_data.txt      → 30+ mẫu hội thoại tự nhiên
├── product_data.txt       → Thông tin sản phẩm, danh mục, cấu trúc DB
├── faq_data.txt           → 40+ câu hỏi thường gặp
├── policies.txt           → Chính sách mua hàng, thanh toán, đổi trả
└── readme.txt             → File này (hướng dẫn sử dụng)

============================================

📄 CHI TIẾT CÁC FILE

1. training_data.txt (Dữ liệu huấn luyện chính)
   - 30 mẫu hội thoại tự nhiên người dùng ↔ chatbot
   - Bám sát dữ liệu thật từ hệ thống (models, controllers, routes)
   - Phân loại theo chủ đề:
     + Mua sắm & sản phẩm (10 mẫu)
     + Tài khoản & bảo mật (4 mẫu)
     + Shop & người bán (4 mẫu)
     + Hỗ trợ & khiếu nại (2 mẫu)
     + Tính năng độc biệt (5 mẫu)
     + Danh mục sản phẩm (5 mẫu)
   - Ngôn ngữ: Tiếng Việt tự nhiên, thân thiện
   - Định dạng: Q&A rõ ràng, dễ parse

2. product_data.txt (Dữ liệu sản phẩm)
   - Cấu trúc bảng products từ database
   - 5 danh mục chính: Điện thoại, Thời trang, Đồ gia dụng, Laptop, Sách
   - Thông tin chi tiết 5 sản phẩm mẫu
   - Phân loại sản phẩm (variations, combinations)
   - Hình ảnh sản phẩm
   - Sản phẩm bán chạy
   - Giá, tồn kho, trạng thái
   - Nguồn: app/Models/Products.php, migrations, UserController.php

3. faq_data.txt (Câu hỏi thường gặp)
   - 40 câu hỏi thường gặp từ khách hàng
   - Phân loại 8 nhóm:
     + Tài khoản & bảo mật (5 câu)
     + Thanh toán (5 câu)
     + Đơn hàng & giao hàng (5 câu)
     + Đổi trả & hoàn tiền (5 câu)
     + Mã giảm giá & khuyến mãi (5 câu)
     + Shop & người bán (5 câu)
     + Hỗ trợ khách hàng (5 câu)
     + Bảo mật & an toàn (5 câu)
   - Nguồn: resources/views/support.blade.php
   - Định dạng: Question → Answer rõ ràng

4. policies.txt (Chính sách & điều khoản)
   - Giới thiệu về VieS (sứ mệnh, giá trị cốt lõi)
   - Chính sách mua hàng
   - Chính sách thanh toán
   - Chính sách vận chuyển
   - Chính sách đổi trả & bảo hành
   - Chính sách bảo mật thông tin
   - Chính sách dành cho người bán
   - Khiếu nại & tranh chấp
   - Điều khoản sử dụng
   - Nguồn: resources/views/about.blade.php, logic hệ thống

5. readme.txt (File này)
   - Hướng dẫn sử dụng toàn bộ bộ dữ liệu
   - Cách huấn luyện chatbot
   - Tích hợp vào website Laravel

============================================

🚀 CÁCH SỬ DỤNG - HUẤN LUYỆN CHATBOT

>>> OPTION 1: SỬ DỤNG CHATBASE (Khuyến nghị)

Chatbase là nền tảng no-code để tạo chatbot AI.

Bước 1: Đăng ký tài khoản
- Truy cập: https://www.chatbase.co/
- Đăng ký miễn phí hoặc trả phí (tùy nhu cầu)

Bước 2: Tạo chatbot mới
- Nhấn "Create Chatbot"
- Chọn "Custom Data" (dữ liệu tùy chỉnh)

Bước 3: Upload dữ liệu
- Tab "Data Sources" → "Add Data"
- Upload 4 file:
  + training_data.txt
  + product_data.txt
  + faq_data.txt
  + policies.txt
- Hoặc copy-paste nội dung trực tiếp

Bước 4: Cấu hình chatbot
- Đặt tên: "VieS Support Bot"
- Ngôn ngữ: Tiếng Việt
- Tone: Thân thiện, chuyên nghiệp
- Instruction (Hướng dẫn cho AI):
  "Bạn là trợ lý ảo của VieS, nền tảng thương mại điện tử Việt Nam.
   Nhiệm vụ: Hỗ trợ khách hàng về sản phẩm, đơn hàng, thanh toán, chính sách.
   Phong cách: Thân thiện, lịch sự, chuyên nghiệp.
   Luôn kết thúc bằng 'ạ' và hỏi thêm nếu khách cần hỗ trợ."

Bước 5: Training (Huấn luyện)
- Chatbase tự động phân tích và huấn luyện
- Thời gian: 2-5 phút

Bước 6: Test chatbot
- Tab "Test" → Gõ thử các câu hỏi:
  + "Tôi muốn mua laptop"
  + "Làm sao để đổi trả hàng?"
  + "Mã giảm giá WELCOME2025 dùng thế nào?"
- Kiểm tra độ chính xác

Bước 7: Nhúng vào website Laravel
- Tab "Embed" → Copy mã embed:
  <script src="https://www.chatbase.co/embed.min.js" 
          chatbotId="YOUR_CHATBOT_ID" 
          domain="www.chatbase.co" 
          defer>
  </script>

- Dán vào file: resources/views/layouts/app.blade.php
- Hoặc resources/views/footer.blade.php (trước </body>)

- Chatbot sẽ hiển thị ở góc dưới phải màn hình


>>> OPTION 2: SỬ DỤNG DIALOGFLOW (Google)

Bước 1: Tạo agent mới trên Dialogflow ES hoặc CX
- Truy cập: https://dialogflow.cloud.google.com/
- Tạo agent: "VieS Support"
- Ngôn ngữ: Vietnamese

Bước 2: Tạo Intents (Ý định)
- Intent 1: "Hỏi về sản phẩm"
  + Training phrases: "Tôi muốn mua điện thoại", "VieS có bán laptop không?"
  + Response: "Dạ, VieS có danh mục [tên danh mục]..."

- Intent 2: "Hỏi về thanh toán"
  + Training phrases: "Thanh toán như thế nào?", "Có hỗ trợ COD không?"
  + Response: Lấy từ faq_data.txt Q6

- Tạo tương tự cho các intents khác (đổi trả, mã giảm giá, tài khoản...)

Bước 3: Import dữ liệu hàng loạt
- Sử dụng file training_data.txt và faq_data.txt
- Convert sang format JSON của Dialogflow
- Import qua API hoặc giao diện

Bước 4: Tích hợp vào Laravel
- Cài đặt SDK:
  composer require google/cloud-dialogflow

- Tạo controller:
  php artisan make:controller ChatbotController

- Code mẫu (ChatbotController.php):

<?php
namespace App\Http\Controllers;

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $text = $request->input('message');
        $projectId = 'your-project-id';
        $sessionId = session()->getId();
        
        $sessionsClient = new SessionsClient([
            'credentials' => storage_path('app/google-credentials.json')
        ]);
        $session = $sessionsClient->sessionName($projectId, $sessionId);
        
        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode('vi');
        
        $queryInput = new QueryInput();
        $queryInput->setText($textInput);
        
        $response = $sessionsClient->detectIntent($session, $queryInput);
        $queryResult = $response->getQueryResult();
        
        return response()->json([
            'reply' => $queryResult->getFulfillmentText()
        ]);
    }
}

- Tạo route:
Route::post('/chatbot', [ChatbotController::class, 'chat']);

- Giao diện chat trong view:
<div id="chatbox">
    <div id="messages"></div>
    <input type="text" id="user-input" placeholder="Nhập câu hỏi...">
    <button onclick="sendMessage()">Gửi</button>
</div>

<script>
function sendMessage() {
    let message = document.getElementById('user-input').value;
    fetch('/chatbot', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({message: message})
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('messages').innerHTML += 
            '<p><strong>Bot:</strong> ' + data.reply + '</p>';
    });
}
</script>


>>> OPTION 3: TỰ XÂY DỰNG CHATBOT (Advanced)

Sử dụng OpenAI API (GPT-3.5/GPT-4) hoặc open-source model

Bước 1: Cài đặt OpenAI PHP Client
composer require openai-php/client

Bước 2: Load dữ liệu huấn luyện vào context
- Đọc 4 file .txt
- Ghép thành 1 context dài
- Gửi kèm mỗi request

Bước 3: Code ChatbotController

<?php
namespace App\Http\Controllers;

use OpenAI;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $client = OpenAI::client(env('OPENAI_API_KEY'));
        
        // Load dữ liệu
        $trainingData = file_get_contents(base_path('chatbot_data/training_data.txt'));
        $faqData = file_get_contents(base_path('chatbot_data/faq_data.txt'));
        $productData = file_get_contents(base_path('chatbot_data/product_data.txt'));
        $policiesData = file_get_contents(base_path('chatbot_data/policies.txt'));
        
        $systemPrompt = "Bạn là trợ lý ảo của VieS. Dựa vào dữ liệu sau để trả lời:\n\n";
        $systemPrompt .= $trainingData . "\n\n" . $faqData;
        
        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $request->input('message')]
            ],
        ]);
        
        return response()->json([
            'reply' => $result->choices[0]->message->content
        ]);
    }
}

Bước 4: Tối ưu
- Cache context để không phải load file mỗi request
- Giới hạn độ dài context
- Sử dụng vector database (Pinecone, Weaviate) cho search nhanh hơn

============================================

🎨 TÍCH HỢP GIAO DIỆN CHATBOT

>>> Giao diện cơ bản (HTML + CSS + JS)

Thêm vào resources/views/layouts/app.blade.php:

<!-- Chat Widget -->
<div id="chat-widget" class="chat-widget">
    <div class="chat-header" onclick="toggleChat()">
        <i class="fas fa-comments"></i> Hỗ trợ trực tuyến
    </div>
    <div class="chat-body" id="chat-body" style="display: none;">
        <div class="chat-messages" id="chat-messages"></div>
        <div class="chat-input">
            <input type="text" id="chat-input" placeholder="Nhập câu hỏi..." 
                   onkeypress="if(event.key==='Enter') sendChatMessage()">
            <button onclick="sendChatMessage()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<style>
.chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 350px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-radius: 12px;
    overflow: hidden;
    z-index: 9999;
}
.chat-header {
    background: linear-gradient(90deg, #0B3C5D, #FF8C00);
    color: white;
    padding: 15px;
    font-weight: bold;
    cursor: pointer;
}
.chat-body {
    background: white;
    height: 400px;
    display: flex;
    flex-direction: column;
}
.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
}
.chat-input {
    display: flex;
    padding: 10px;
    border-top: 1px solid #eee;
}
.chat-input input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
    outline: none;
}
.chat-input button {
    margin-left: 10px;
    padding: 10px 15px;
    background: #FF8C00;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
}
.message {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 8px;
}
.message.user {
    background: #e3f2fd;
    text-align: right;
}
.message.bot {
    background: #f5f5f5;
}
</style>

<script>
function toggleChat() {
    let body = document.getElementById('chat-body');
    body.style.display = body.style.display === 'none' ? 'flex' : 'none';
}

function sendChatMessage() {
    let input = document.getElementById('chat-input');
    let message = input.value.trim();
    if (!message) return;
    
    // Hiển thị tin nhắn người dùng
    let messagesDiv = document.getElementById('chat-messages');
    messagesDiv.innerHTML += '<div class="message user">' + message + '</div>';
    input.value = '';
    
    // Gọi API chatbot
    fetch('/chatbot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({message: message})
    })
    .then(res => res.json())
    .then(data => {
        messagesDiv.innerHTML += '<div class="message bot">' + data.reply + '</div>';
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    })
    .catch(err => {
        messagesDiv.innerHTML += '<div class="message bot">Xin lỗi, có lỗi xảy ra. Vui lòng thử lại sau.</div>';
    });
}
</script>

============================================

📊 ĐÁNH GIÁ & TỐI ƯU

>>> Test độ chính xác

Danh sách 20 câu hỏi test:
1. "Tôi muốn mua iPhone 15"
2. "Làm sao để đổi trả hàng?"
3. "Mã giảm giá WELCOME2025 dùng như thế nào?"
4. "VieS có bán laptop không?"
5. "Thanh toán COD là gì?"
6. "Bao lâu tôi nhận được hàng?"
7. "Tôi quên mật khẩu phải làm sao?"
8. "Làm sao để mở shop bán hàng?"
9. "Hoa hồng VieS là bao nhiêu?"
10. "Shop không phản hồi tin nhắn?"
11. "Tôi muốn khiếu nại shop"
12. "Đánh giá sản phẩm như thế nào?"
13. "VieS có hỗ trợ MoMo không?"
14. "Sản phẩm bị lỗi, hoàn tiền được không?"
15. "Tôi có thể dùng nhiều mã giảm giá cùng lúc không?"
16. "Làm sao để theo dõi đơn hàng?"
17. "VieS có bán sách không?"
18. "Phí ship bao nhiêu?"
19. "Tài khoản bị khóa phải làm sao?"
20. "Thông tin cá nhân có được bảo mật không?"

Mục tiêu: Bot trả lời đúng 18/20 câu (90%)

>>> Cải thiện chatbot

1. Bổ sung dữ liệu:
   - Thêm câu hỏi mới từ khách hàng thật
   - Cập nhật khi có sản phẩm mới
   - Thêm ngữ cảnh địa phương (tiếng lóng, viết tắt)

2. Fine-tuning:
   - Sử dụng dữ liệu chat thật
   - Train lại model định kỳ
   - A/B testing các phiên bản bot

3. Theo dõi metrics:
   - Số lượng hội thoại/ngày
   - Tỷ lệ giải quyết thành công
   - Thời gian phản hồi
   - Độ hài lòng khách hàng (rating)

============================================

⚠️ LƯU Ý QUAN TRỌNG

1. Bảo mật:
   - KHÔNG lưu API key trong code
   - Sử dụng .env: OPENAI_API_KEY=your-key
   - KHÔNG commit file credentials lên Git

2. Chi phí:
   - Chatbase: Miễn phí tối đa 30 tin nhắn/tháng, trả phí từ $19/tháng
   - OpenAI API: ~$0.002/1000 tokens (rất rẻ)
   - Dialogflow: Miễn phí tối đa 180 requests/phút

3. Giới hạn:
   - Context length: GPT-3.5 hỗ trợ tối đa 4096 tokens
   - Nếu dữ liệu quá dài, chia nhỏ hoặc dùng vector search

4. Compliance:
   - Tuân thủ chính sách OpenAI/Google
   - Không train model với dữ liệu nhạy cảm (thông tin cá nhân, thẻ tín dụng)
   - GDPR/CCPA nếu có khách quốc tế

============================================

📞 HỖ TRỢ & LIÊN HỆ

Nếu gặp vấn đề khi sử dụng bộ dữ liệu này:

1. Đọc kỹ hướng dẫn trong file này
2. Kiểm tra log lỗi Laravel: storage/logs/laravel.log
3. Google/StackOverflow với từ khóa cụ thể
4. Liên hệ team phát triển VieS

Email: dev@vies.vn
Hotline kỹ thuật: [Số hotline]

============================================

🎉 KẾT LUẬN

Bộ dữ liệu này cung cấp đầy đủ thông tin để huấn luyện một chatbot thông minh cho VieS.

KHUYẾN NGHỊ:
- Bắt đầu với Chatbase (dễ nhất, không cần code)
- Sau đó chuyển sang OpenAI API hoặc tự host (nếu cần tùy biến cao)
- Liên tục cập nhật dữ liệu để chatbot thông minh hơn

THỜI GIAN ƯỚC TÍNH:
- Setup Chatbase: 30 phút
- Setup Dialogflow: 2-3 giờ
- Tự xây dựng với OpenAI: 4-8 giờ (tùy kỹ năng)

CHÚC BẠN THÀNH CÔNG! 🚀

============================================
Phiên bản: 1.0
Ngày tạo: 2025-10-23
Tác giả: VieS Development Team
============================================

