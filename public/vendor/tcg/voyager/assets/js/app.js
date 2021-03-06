$(document).ready(function(){
  $('#voyager-loader').fadeOut();
  $('.readmore').readmore({
    lessLink: '<a href="#" class="readm-link">Read Less</a>',
    moreLink: '<a href="#" class="readm-link">Read More</a>',
  });
});

$(function() {
  $(".hamburger").click(function() {
    $(".app-container").toggleClass("expanded");
    $(this).toggleClass("is-active");
    if ($(this).hasClass("is-active")) {
      $.cookie("expandedMenu", 1);
    } else {
      $.cookie("expandedMenu", 0);
    }
  });
});

$(function() {
  return $('select.select2').select2();
});

$(function() {
  return $('.toggle-checkbox').bootstrapSwitch({
    size: "small"
  });
});

$(function() {
  return $('.match-height').matchHeight();
});

$(function() {
  return $('.datatable').DataTable({
    "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>'
  });
});

$(function() {
  return $(".side-menu .nav .dropdown").on('show.bs.collapse', function() {
    return $(".side-menu .nav .dropdown .collapse").collapse('hide');
  });
});

$('#dataTable').DataTable({
  "oLanguage": {
    "sSearch": "بحث: ",
    "oPaginate": {
      "sNext": "التالي",
      "sPrevious": "السابق",
      "sInfo": "Got a total of _TOTAL_ entries to show (_START_ to _END_)"
    }
  },
  "order": [],
  "sDom": '<"top"fl>rt<"bottom pull-left"p><"bottom pull-right"i><"clear">'
});
