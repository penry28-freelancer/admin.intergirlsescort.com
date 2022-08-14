import { updateStateURL } from '../utils/helpers.js';

(function($) {
  // =========================================
  // Settings Profile Handler
  // =========================================
  $(function() {
    // Listen change tab to submit form setting
    $("[data-button='save-settings-profile']").click(function() {
      $("[data-setting-profile-tabs] [data-setting-profile-tab].active").find('form').submit();
    });

    // Listen tab panel change to update url
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
      const hrefTab = $(this).attr('data-href-tab');
      updateStateURL('?tab=' + hrefTab);
    });

    // Validate form setting account
    $("[data-form='profile-setting-account']").validate({
      rules: {
        "name": {
          required: true,
          maxlength: 10,
          minlength: 2,
        },
        "username": {
          required: true,
          maxlength: 255,
          validate_username: true,
        },
        "email": {
          required: true,
          maxlength: 255,
          validate_email: true,
        },
        "phone": {
          validate_phone: true,
        },
        "dob": {
          required: true,
        },
        "mob": {
          required: true,
        },
        "yob": {
          required: true,
        },
      },
      messages: {
        "name": {
          required: "Vui lòng nhập tên của bạn",
          maxlength: "Tên của bạn tối chỉ đa 10 ký tự",
          minlength: "Tên của bạn tối phải thiểu 2 ký tự"
        },
        "username": {
          required: "Vui lòng nhập username",
          maxlength: "Username không được vượt quá 255 ký tự",
          validate_username: "Username chỉ có thể tồn tại ký tự thường (a-z), chữ số (0-9), dấu chấm (.), dấu ghạch dưới (_)"
        },
        "email": {
          required: "Vui lòng nhập địa chỉ e-mail",
          maxlength: "Địa chỉ mail chỉ tối đa 255 ký tự",
          validate_email: "Vui lòng nhập một e-mail hợp lệ"
        },
        "phone": {
          validate_phone: "Số điện thoại không hợp lệ",
        },
        "dob": {
          required: "",
        },
        "mob": {
          required: "",
        },
        "yob": {
          required: ""
        }
      },
    });

    // Validate form setting password
    $("[data-form='profile-setting-password']").validate({
      rules: {
        "password_old": {
          required: true,
        },
        "password": {
          validate_password: true,
        },
        "password_confirmation": {
          equalTo: "#password"
        },
      },
      messages: {
        "password_old": {
          required: "Vui lòng nhập mật khẩu cũ",
        },
        "password": {
          validate_password: "Mật khẩu yêu cầu tối thiểu 8 ký tự và phải tồn tại ký tự hoa, thường, chữ số và ký tự đặt biệt"
        },
        "password_confirmation": {
          equalTo: "Mật khẩu nhập lại không khớp"
        }
      }
    });
  });

  // ================================
  // ======== Profile Detail ========
  // ================================
  $(function() {
    // Change active Avatar
    $("[data-selection='avatar']").click(function() {
      $("[data-selection='avatar']").removeClass('active');
      $("[data-form-avatar-value]").val($(this).data('avatar'));
      $(this).addClass('active');
    });

    // Listen when modal update avatar close
    $("[data-modal='update-avatar']").on('hidden.bs.modal', function () {
      const avatar = $("[data-form-avatar-value]").data('form-avatar-value');
      $("[data-form-avatar-value]").val(avatar);
      $("[data-selection='avatar']").removeClass('active');
      $("[data-avatar='"+ avatar +"']").addClass('active');
    });
  });
})(jQuery);
