<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Models\SubCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SearchSuggestionController extends Controller
{
    /**
     * API gợi ý tìm kiếm real-time
     */
    public function getSuggestions(Request $request)
    {
        $keyword = trim($request->input('q', ''));
        
        if (strlen($keyword) < 2) {
            return response()->json([
                'suggestions' => $this->getTrendingKeywords(),
                'type' => 'trending'
            ]);
        }

        $suggestions = Cache::remember("search_suggestions_{$keyword}", 300, function() use ($keyword) {
            return $this->buildSuggestions($keyword);
        });

        return response()->json([
            'suggestions' => $suggestions,
            'type' => 'search'
        ]);
    }

    /**
     * Xây dựng danh sách gợi ý
     */
    private function buildSuggestions($keyword)
    {
        $suggestions = [];
        
        // 1. Gợi ý từ tên sản phẩm
        $productSuggestions = $this->getProductSuggestions($keyword);
        
        // 2. Gợi ý từ danh mục
        $categorySuggestions = $this->getCategorySuggestions($keyword);
        
        // 3. Gợi ý từ từ khóa phổ biến
        $popularSuggestions = $this->getPopularSuggestions($keyword);
        
        // 4. Gợi ý thông minh
        $smartSuggestions = $this->getSmartSuggestions($keyword);
        
        // Kết hợp và sắp xếp
        $suggestions = array_merge(
            $productSuggestions,
            $categorySuggestions, 
            $popularSuggestions,
            $smartSuggestions
        );
        
        // Loại bỏ trùng lặp và giới hạn kết quả
        $suggestions = array_unique($suggestions);
        $suggestions = array_slice($suggestions, 0, 10);
        
        return $suggestions;
    }

    /**
     * Gợi ý từ tên sản phẩm
     */
    private function getProductSuggestions($keyword)
    {
        $products = Products::select('productName')
            ->where('productName', 'LIKE', $keyword . '%')
            ->where('status', 1)
            ->groupBy('productName')
            ->orderByRaw('LENGTH(productName) ASC')
            ->limit(5)
            ->get();

        return $products->pluck('productName')->toArray();
    }

    /**
     * Gợi ý từ danh mục
     */
    private function getCategorySuggestions($keyword)
    {
        $categories = Categories::select('categoryName')
            ->where('categoryName', 'LIKE', '%' . $keyword . '%')
            ->limit(3)
            ->get();

        return $categories->pluck('categoryName')->toArray();
    }

    /**
     * Gợi ý từ từ khóa phổ biến
     */
    private function getPopularSuggestions($keyword)
    {
        $popularKeywords = [
            'áo', 'quần', 'giày', 'túi', 'điện thoại', 'laptop', 'máy ảnh',
            'sách', 'đồ chơi', 'nhà cửa', 'sức khỏe', 'thời trang', 'công nghệ',
            'áo thun', 'quần jean', 'giày thể thao', 'túi xách', 'điện thoại samsung',
            'laptop dell', 'máy ảnh canon', 'sách văn học', 'đồ chơi lego'
        ];

        $suggestions = [];
        foreach ($popularKeywords as $popular) {
            if (stripos($popular, $keyword) !== false) {
                $suggestions[] = $popular;
            }
        }

        return array_slice($suggestions, 0, 3);
    }

    /**
     * Gợi ý thông minh dựa trên ngữ cảnh
     */
    private function getSmartSuggestions($keyword)
    {
        $smartMap = [
            'áo' => ['áo thun', 'áo sơ mi', 'áo khoác', 'áo len', 'áo vest'],
            'quần' => ['quần jean', 'quần tây', 'quần short', 'quần jogger'],
            'giày' => ['giày thể thao', 'giày tây', 'giày boot', 'giày sneaker'],
            'điện thoại' => ['điện thoại samsung', 'điện thoại iphone', 'điện thoại xiaomi'],
            'laptop' => ['laptop dell', 'laptop asus', 'laptop hp', 'laptop lenovo'],
            'máy ảnh' => ['máy ảnh canon', 'máy ảnh nikon', 'máy ảnh sony'],
            'sách' => ['sách văn học', 'sách kinh tế', 'sách kỹ năng', 'sách thiếu nhi'],
            'đồ chơi' => ['đồ chơi lego', 'đồ chơi barbie', 'đồ chơi robot'],
            'nhà cửa' => ['nội thất', 'đồ trang trí', 'đồ gia dụng'],
            'sức khỏe' => ['thực phẩm chức năng', 'dụng cụ y tế', 'mỹ phẩm']
        ];

        $suggestions = [];
        foreach ($smartMap as $key => $values) {
            if (stripos($keyword, $key) !== false) {
                $suggestions = array_merge($suggestions, $values);
            }
        }

        return array_slice($suggestions, 0, 3);
    }

    /**
     * Lấy từ khóa trending
     */
    private function getTrendingKeywords()
    {
        return Cache::remember('trending_keywords', 3600, function() {
            return [
                'áo thun nam',
                'quần jean nữ', 
                'giày thể thao',
                'điện thoại samsung',
                'laptop gaming',
                'máy ảnh canon',
                'sách văn học',
                'đồ chơi lego',
                'nội thất phòng khách',
                'mỹ phẩm chăm sóc da'
            ];
        });
    }

    /**
     * Lưu từ khóa tìm kiếm để phân tích
     */
    public function trackSearch(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));
        
        if (strlen($keyword) >= 2) {
            // Lưu vào cache để tracking
            $searchCounts = Cache::get('search_counts', []);
            $searchCounts[$keyword] = ($searchCounts[$keyword] ?? 0) + 1;
            Cache::put('search_counts', $searchCounts, 86400); // 24 hours
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Lấy từ khóa hot nhất
     */
    public function getHotKeywords()
    {
        $searchCounts = Cache::get('search_counts', []);
        arsort($searchCounts);
        
        return response()->json([
            'hot_keywords' => array_slice(array_keys($searchCounts), 0, 10, true)
        ]);
    }

    /**
     * Gợi ý sản phẩm liên quan
     */
    public function getRelatedProducts(Request $request)
    {
        $productId = $request->input('product_id');
        $limit = $request->input('limit', 5);
        
        if (!$productId) {
            return response()->json(['products' => []]);
        }

        $product = Products::find($productId);
        if (!$product) {
            return response()->json(['products' => []]);
        }

        // Tìm sản phẩm cùng danh mục
        $relatedProducts = Products::where('category_id', $product->category_id)
            ->where('id', '!=', $productId)
            ->where('status', 1)
            ->select('id', 'productName', 'price', 'previewImage')
            ->limit($limit)
            ->get();

        return response()->json(['products' => $relatedProducts]);
    }

    /**
     * Gợi ý dựa trên lịch sử tìm kiếm
     */
    public function getSearchHistory(Request $request)
    {
        $userId = $request->input('user_id');
        
        if (!$userId) {
            return response()->json(['history' => []]);
        }

        // Lấy lịch sử từ session hoặc database
        $searchHistory = Cache::get("search_history_{$userId}", []);
        
        return response()->json([
            'history' => array_slice($searchHistory, 0, 10)
        ]);
    }

    /**
     * Lưu lịch sử tìm kiếm
     */
    public function saveSearchHistory(Request $request)
    {
        $userId = $request->input('user_id');
        $keyword = trim($request->input('keyword', ''));
        
        if ($userId && strlen($keyword) >= 2) {
            $searchHistory = Cache::get("search_history_{$userId}", []);
            
            // Loại bỏ nếu đã tồn tại
            $searchHistory = array_diff($searchHistory, [$keyword]);
            
            // Thêm vào đầu
            array_unshift($searchHistory, $keyword);
            
            // Giới hạn 20 từ khóa
            $searchHistory = array_slice($searchHistory, 0, 20);
            
            Cache::put("search_history_{$userId}", $searchHistory, 86400 * 30); // 30 days
        }

        return response()->json(['status' => 'success']);
    }
}
