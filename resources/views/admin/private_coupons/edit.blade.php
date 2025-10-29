<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Chỉnh sửa mã giảm giá riêng</title>
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style>
        .form-section {
            background: #f8f9fc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .form-section h6 {
            color: #4e73df;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .preview-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
        }
        .preview-code {
            font-family: 'Courier New', monospace;
            font-size: 1.5rem;
            font-weight: bold;
            background: rgba(255,255,255,0.2);
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }
        .stats-info {
            background: #e3f2fd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.sidebaradmin')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('admin.topbaradmin')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <i class="fas fa-edit text-primary mr-2"></i>
                            Chỉnh sửa mã giảm giá: {{ $privateCoupon->code }}
                        </h1>
                        <a href="{{ route('private-coupons.index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
                            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại
                        </a>
                    </div>

                    @php
                        $message = Session::get('message');
                        $error = Session::get('error');
                        if(isset($message)){
                            echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
                            Session::put('message',null);
                        }
                        if(isset($error)){
                            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                            Session::put('error',null);
                        }
                    @endphp

                    <!-- Stats Info -->
                    <div class="stats-info">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Đã sử dụng:</strong> {{ $privateCoupon->used_count }} lần
                            </div>
                            <div class="col-md-3">
                                <strong>Giới hạn:</strong> {{ $privateCoupon->usage_limit ?? 'Không giới hạn' }}
                            </div>
                            <div class="col-md-3">
                                <strong>Trạng thái:</strong> 
                                <span class="badge {{ $privateCoupon->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $privateCoupon->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                                </span>
                            </div>
                            <div class="col-md-3">
                                <strong>Hết hạn:</strong> {{ \Carbon\Carbon::parse($privateCoupon->end_date)->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('private-coupons.update', $privateCoupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Basic Information -->
                                <div class="form-section">
                                    <h6><i class="fas fa-info-circle mr-2"></i>Thông tin cơ bản</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="code">Mã giảm giá <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                                       id="code" name="code" value="{{ old('code', $privateCoupon->code) }}" 
                                                       placeholder="VD: NHUTLINH2025" required>
                                                @error('code')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Mã sẽ được chuyển thành chữ hoa</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Tên mã giảm giá <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" value="{{ old('name', $privateCoupon->name) }}" 
                                                       placeholder="VD: Giảm giá đặc biệt" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="3" 
                                                  placeholder="Mô tả về mã giảm giá...">{{ old('description', $privateCoupon->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Discount Configuration -->
                                <div class="form-section">
                                    <h6><i class="fas fa-percentage mr-2"></i>Cấu hình giảm giá</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Loại giảm giá <span class="text-danger">*</span></label>
                                                <select class="form-control @error('type') is-invalid @enderror" 
                                                        id="type" name="type" required>
                                                    <option value="">Chọn loại</option>
                                                    <option value="percentage" {{ old('type', $privateCoupon->type) == 'percentage' ? 'selected' : '' }}>Phần trăm (%)</option>
                                                    <option value="fixed" {{ old('type', $privateCoupon->type) == 'fixed' ? 'selected' : '' }}>Số tiền cố định (VNĐ)</option>
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="value">Giá trị giảm giá <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('value') is-invalid @enderror" 
                                                       id="value" name="value" value="{{ old('value', $privateCoupon->value) }}" 
                                                       step="0.01" min="0" placeholder="VD: 10" required>
                                                @error('value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted" id="value-help">Nhập số tiền hoặc phần trăm</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="minimum_amount">Đơn hàng tối thiểu (VNĐ)</label>
                                                <input type="number" class="form-control @error('minimum_amount') is-invalid @enderror" 
                                                       id="minimum_amount" name="minimum_amount" value="{{ old('minimum_amount', $privateCoupon->minimum_amount) }}" 
                                                       step="1000" min="0" placeholder="VD: 100000">
                                                @error('minimum_amount')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="maximum_discount">Giảm tối đa (VNĐ)</label>
                                                <input type="number" class="form-control @error('maximum_discount') is-invalid @enderror" 
                                                       id="maximum_discount" name="maximum_discount" value="{{ old('maximum_discount', $privateCoupon->maximum_discount) }}" 
                                                       step="1000" min="0" placeholder="VD: 500000">
                                                @error('maximum_discount')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Usage & Validity -->
                                <div class="form-section">
                                    <h6><i class="fas fa-calendar-alt mr-2"></i>Thời gian và giới hạn</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Ngày bắt đầu <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                                       id="start_date" name="start_date" value="{{ old('start_date', $privateCoupon->start_date->format('Y-m-d')) }}" required>
                                                @error('start_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">Ngày kết thúc <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                                       id="end_date" name="end_date" value="{{ old('end_date', $privateCoupon->end_date->format('Y-m-d')) }}" required>
                                                @error('end_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="usage_limit">Giới hạn sử dụng</label>
                                                <input type="number" class="form-control @error('usage_limit') is-invalid @enderror" 
                                                       id="usage_limit" name="usage_limit" value="{{ old('usage_limit', $privateCoupon->usage_limit) }}" 
                                                       min="1" placeholder="Để trống = không giới hạn">
                                                @error('usage_limit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="shop_id">Áp dụng cho cửa hàng</label>
                                                <select class="form-control @error('shop_id') is-invalid @enderror" 
                                                        id="shop_id" name="shop_id">
                                                    <option value="">Tất cả cửa hàng</option>
                                                    @foreach($shops as $shop)
                                                        <option value="{{ $shop->id }}" {{ old('shop_id', $privateCoupon->shop_id) == $shop->id ? 'selected' : '' }}>
                                                            {{ $shop->shopname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('shop_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                                   {{ old('is_active', $privateCoupon->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Kích hoạt mã giảm giá
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Preview -->
                                <div class="preview-card">
                                    <h5 class="mb-3"><i class="fas fa-eye mr-2"></i>Xem trước</h5>
                                    <div class="preview-code" id="preview-code">{{ $privateCoupon->code }}</div>
                                    <div class="mt-3">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <small>Loại:</small><br>
                                                <strong id="preview-type">Phần trăm</strong>
                                            </div>
                                            <div class="col-6">
                                                <small>Giá trị:</small><br>
                                                <strong id="preview-value">10%</strong>
                                            </div>
                                        </div>
                                        <div class="row text-center mt-2">
                                            <div class="col-6">
                                                <small>Đơn tối thiểu:</small><br>
                                                <strong id="preview-min">100,000đ</strong>
                                            </div>
                                            <div class="col-6">
                                                <small>Giảm tối đa:</small><br>
                                                <strong id="preview-max">500,000đ</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="card shadow mt-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Thao tác</h6>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-save mr-2"></i>Cập nhật mã giảm giá
                                        </button>
                                        <a href="{{ route('private-coupons.index') }}" class="btn btn-secondary btn-block">
                                            <i class="fas fa-times mr-2"></i>Hủy
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        // Preview functionality
        function updatePreview() {
            const code = document.getElementById('code').value || '{{ $privateCoupon->code }}';
            const type = document.getElementById('type').value;
            const value = document.getElementById('value').value || '{{ $privateCoupon->value }}';
            const minAmount = document.getElementById('minimum_amount').value;
            const maxDiscount = document.getElementById('maximum_discount').value;

            document.getElementById('preview-code').textContent = code.toUpperCase();
            
            if (type === 'percentage') {
                document.getElementById('preview-type').textContent = 'Phần trăm';
                document.getElementById('preview-value').textContent = value + '%';
            } else if (type === 'fixed') {
                document.getElementById('preview-type').textContent = 'Số tiền';
                document.getElementById('preview-value').textContent = new Intl.NumberFormat('vi-VN').format(value) + 'đ';
            }

            document.getElementById('preview-min').textContent = minAmount ? 
                new Intl.NumberFormat('vi-VN').format(minAmount) + 'đ' : 'Không';
            document.getElementById('preview-max').textContent = maxDiscount ? 
                new Intl.NumberFormat('vi-VN').format(maxDiscount) + 'đ' : 'Không';
        }

        // Update preview on input change
        document.getElementById('code').addEventListener('input', updatePreview);
        document.getElementById('type').addEventListener('change', updatePreview);
        document.getElementById('value').addEventListener('input', updatePreview);
        document.getElementById('minimum_amount').addEventListener('input', updatePreview);
        document.getElementById('maximum_discount').addEventListener('input', updatePreview);

        // Update value help text based on type
        document.getElementById('type').addEventListener('change', function() {
            const helpText = document.getElementById('value-help');
            if (this.value === 'percentage') {
                helpText.textContent = 'Nhập phần trăm (VD: 10 = 10%)';
            } else if (this.value === 'fixed') {
                helpText.textContent = 'Nhập số tiền VNĐ (VD: 50000 = 50,000đ)';
            }
        });

        // Initialize preview
        updatePreview();
    </script>
</body>
</html>
