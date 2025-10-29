// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language": {
      "sProcessing": "Đang xử lý...",
      "sLengthMenu": "Hiển thị _MENU_ mục",
      "sZeroRecords": "Không tìm thấy dữ liệu",
      "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
      "sInfoEmpty": "Hiển thị 0 đến 0 của 0 mục",
      "sInfoFiltered": "(được lọc từ _MAX_ mục)",
      "sInfoPostFix": "",
      "sSearch": "Tìm kiếm:",
      "sUrl": "",
      "oPaginate": {
        "sFirst": "Đầu",
        "sPrevious": "Trước",
        "sNext": "Tiếp",
        "sLast": "Cuối"
      }
    }
  });
});
