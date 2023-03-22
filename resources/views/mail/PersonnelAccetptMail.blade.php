<h4>Chào bạn {{ $cver->name }},</h4>
<br>
Lời đầu tiên, chúng tôi xin cảm ơn bạn vì đã quan tâm đến vị trí ứng tuyển của công ty SCONNECT. Thông qua hồ sơ mà bạn
<br>
đã gửi về, chúng tôi nhận thấy bạn có kiến thức chuyên môn phù hợp với vị trí mà chúng tôi đang tuyển.
<br>
Chúng tôi trân trọng kính mời bạn đến tham gia buổi phỏng vấn của công ty chúng tôi tại:
<br>
@if ($inter->cate_inter == 1)
    Địa Chỉ :{{ $inter->location }}
@else
    Đường Dẫn :{{ $inter->location }}
@endif
<br>
Hình thức Phỏng Vấn :
@if ($inter->cate_inter == 1)
    Trực Tiếp
@else
    online
@endif
<br>
Vào lúc : {{ $inter->interview_time }} ngày : {{ $inter->interview_date }}
<br>
Để buổi phỏng vấn được diễn ra thuận lợi, bạn vui lòng phản hồi lại email này ngay khi nhận được. Mọi thắc mắc khác, bạn
<br>
vui lòng liên hệ với chúng tôi qua:
<br>
Email :lutl@s-connect.net
<br>
SDT:0866755653
<br>
Địa chỉ liên hệ: 286 Nguyễn Xiển , Thanh Xuân , Hà Nội
<br>
Trân trọng !
<br>
Nhân Sự Hành Chính-SCONNECT.
