import { updateStateURL } from '../utils/helpers.js';

(function($) {
  const GraduateScore = {};
  GraduateScore.toanScore        = "[data-input-score='toan']";
  GraduateScore.vanScore         = "[data-input-score='van']";
  GraduateScore.ngoainguScore    = "[data-input-score='ngoai-ngu']";
  GraduateScore.mon1tohopScore   = "[data-input-score='mon-1-tohop']";
  GraduateScore.mon2tohopScore   = "[data-input-score='mon-2-tohop']";
  GraduateScore.mon3tohopScore   = "[data-input-score='mon-3-tohop']";
  GraduateScore.cn12Score        = "[data-input-score='tb-cn-12']";
  GraduateScore.khuyenkhichScore = "[data-input-score='khuyen-khich']";
  GraduateScore.uutienScore      = "[data-input-score='uu-tien']";
  GraduateScore.khoithi          = "[data-input-type='khoithi']";
  GraduateScore.dxtn             = 0;
  GraduateScore.type             = 0;
  GraduateScore.passedGraduation = false;

  // Listen tab panel change to update url
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    const hrefTab = $(this).attr('data-href-tab');
    if (hrefTab === 'he-gdtx') {
      $(GraduateScore.ngoainguScore).val('');
      $(GraduateScore.ngoainguScore).prop('disabled', true);
      $(GraduateScore.ngoainguScore).removeClass('is-invalid');
    } else {
      $(GraduateScore.ngoainguScore).prop('disabled', false);
    }
  });
  // =========================================
  // Calculate Graduate Score Handler
  // =========================================
  // Initial form
  loadFormByCondition();
  $(GraduateScore.khoithi).on('change', loadFormByCondition);

  function loadFormByCondition() {
    let khoithi = $(GraduateScore.khoithi).val();
    let lable1  = $(GraduateScore.mon1tohopScore).parent().find('label');
    let lable2  = $(GraduateScore.mon2tohopScore).parent().find('label');
    let lable3  = $(GraduateScore.mon3tohopScore).parent().find('label');
    switch (khoithi) {
      case 'khtn':
        lable1.html(`<strong>[ Lý ]</strong> Môn 1 tổ hợp`);
        lable2.html(`<strong>[ Hóa ]</strong> Môn 2 tổ hợp`);
        lable3.html(`<strong>[ Sinh ]</strong> Môn 3 tổ hợp`);
        break;
      case 'khxh':
        lable1.html(`<strong>[ Sử ]</strong> Môn 1 tổ hợp`);
        lable2.html(`<strong>[ Địa ]</strong> Môn 2 tổ hợp`);
        lable3.html(`<strong>[ Công dân ]</strong> Môn 3 tổ hợp`);
        break;
      default:
    }
  }

  // Handle reset data form
  $('[data-button="reset"]').on('click', function() {
    $("[data-form='calculate-graduate-score']")[0].reset();
    $("[data-form='calculate-graduate-score']").validate().resetForm();
  });
  $(function() {
    $("[data-form='calculate-graduate-score']").validate({
      rules: {
        "toanScore": {
          required: true,
          number: true,
          range: [1, 10]
        },
        "vanScore": {
          required: true,
          number: true,
          range: [1, 10]
        },
        "ngoainguScore": {
          required: true,
          number: true,
          range: [1, 10]
        },
        "mon1tohopScore": {
          required: true,
          number: true,
          range: [1, 10]
        },
        "mon2tohopScore": {
          required: true,
          number: true,
          range: [1, 10]
        },
        "mon3tohopScore": {
          required: true,
          number: true,
          range: [1, 10]
        },
        "cn12Score": {
          required: true,
          number: true,
          range: [1, 10]
        },
        "khuyenkhichScore": {
          required: false,
          number: true,
          range: [1, 10]
        },
        "uutienScore": {
          required: false,
          number: true,
          range: [1, 10]
        },
      },
      messages: {
        "toanScore": {
          required: "Vui lòng nhập điểm",
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
        "vanScore": {
          required: "Vui lòng nhập điểm",
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
        "ngoainguScore": {
          required: "Vui lòng nhập điểm",
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
        "mon1tohopScore": {
          required: "Vui lòng nhập điểm",
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
        "mon2tohopScore": {
          required: "Vui lòng nhập điểm",
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
        "mon3tohopScore": {
          required: "Vui lòng nhập điểm",
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
        "cn12Score": {
          required: "Vui lòng nhập điểm",
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
        "khuyenkhichScore": {
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
        "uutienScore": {
          number: "Điểm yêu cầu phải là một số",
          range: "Điểm số nằm trong khoản từ 1-10"
        },
      },
      submitHandler: function() {
        calculateGraduateScoreHandler();
      }
    });

    function calculateGraduateScoreHandler() {
      let _0xf943x2 = +$(GraduateScore.toanScore).val();
      let _0xf943x3 = +$(GraduateScore.vanScore).val();
      let _0xf943x4 = +$(GraduateScore.ngoainguScore).val();
      let _0xf943x5 = +$(GraduateScore.mon1tohopScore).val();
      let _0xf943x6 = +$(GraduateScore.mon2tohopScore).val();
      let _0xf943x7 = +$(GraduateScore.mon3tohopScore).val();
      let _0xf943x8 = +$(GraduateScore.cn12Score).val();
      let _0xf943x9 = +$(GraduateScore.khuyenkhichScore).val();
      let _0xf943xa = +$(GraduateScore.uutienScore).val();

      const typeScore = $('a[data-toggle="tab"].active').attr('data-href-tab');

      if (
        (_0xf943x2 <= 1 || _0xf943x3 <= 1 || _0xf943x5 <= 1 || _0xf943x6 <= 1 || _0xf943x7 <= 1)
        || (typeScore === 'he-gd-thpt' && _0xf943x4 <= 1)
      ) {
        GraduateScore.passedGraduation = false;
        GraduateScore.type = 1;
      } else {
        let _0xf943xb  = (_0xf943x5 + _0xf943x6 + _0xf943x7) / 3;
        let _0xf943xc  = 0;
        switch (typeScore) {
          case 'he-gd-thpt':
            _0xf943xc = (_0xf943x2 + _0xf943x3 + _0xf943x4 + _0xf943xb + _0xf943x9) / 4;
            break;
          case 'he-gdtx':
            _0xf943xc = (_0xf943x2 + _0xf943x3 + _0xf943xb + _0xf943x9) / 3;
            break;
          default:
            throw new Error('Hệ giáo dục khồng tồn tại');
        }

        let _0xf943xd  = _0xf943xc * 0.7 + _0xf943x8 * 0.3 + _0xf943xa;
        let _0xf943xe  = _0xf943xd['toFixed'](2);

        GraduateScore.dxtn = +_0xf943xe;
        GraduateScore.type = 2;

        showResult();

        function showResult() {
          let khoithi = $(GraduateScore.khoithi).val();
          let score   = {};
          switch (khoithi) {
            case 'khtn':
              score.ly   = _0xf943x5;
              score.hoa  = _0xf943x6;
              score.sinh = _0xf943x7;
              break;
            case 'khxh':
              score.su  = _0xf943x5;
              score.dia = _0xf943x6;
              score.cd  = _0xf943x7;
              break;
            default:
          }

          score.toan = _0xf943x2;
          score.van  = _0xf943x3;
          score.anh  = _0xf943x4;
          let scoreParamsTxt = [];
          for (const [key, value] of Object.entries(score)) {
            scoreParamsTxt.push(`score[${key}]=${value}`);
          }

          updateStateURL(`?tab=result&type=${GraduateScore.type}&score[tn]=${GraduateScore.dxtn}&${scoreParamsTxt.join('&')}`);
          location.reload();
        }
      }
    }
  });
})(jQuery);
