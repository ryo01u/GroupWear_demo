// Generated by CoffeeScript 1.7.1
(function() {
  var table_span_wrap;
  table_span_wrap = function(wrap, row, spaned, cell) {
    var i, j, r, rc, rh, s, sh, v, w, _i, _j, _len, _len1, _results;
    w = document.querySelector(wrap);
    if (!w) {
      return;
    }
    r = w.querySelector(row);
    s = w.querySelector(spaned);
    rh = r.offsetHeight;
    sh = s.offsetHeight;
    rc = Array.prototype.slice.call(r.querySelectorAll(cell));
    s.style.height = "auto";
    for (j = _i = 0, _len = rc.length; _i < _len; j = ++_i) {
      w = rc[j];
      w.style.height = "auto";
    }
    if (!(window.innerWidth > 750)) {
      return;
    }
    if (rh > sh) {
      return s.style.height = rh + "px";
    } else if (rh < sh) {
      _results = [];
      for (i = _j = 0, _len1 = rc.length; _j < _len1; i = ++_j) {
        v = rc[i];
        _results.push(v.style.height = v.offsetHeight + (sh - rh) / rc.length + "px");
      }
      return _results;
    }
  };
  window.resize_fn["bass_pc"] = function() {
    table_span_wrap(".table_row_wrap", ".table_row", ".table_row_span", ".table_row_inr");
  };
  window.addEventListener('load', function(e) {
    if (window.innerWidth > 750) {
      table_span_wrap(".table_row_wrap", ".table_row", ".table_row_span", ".table_row_inr");
      tiles('.bass_detail_01 .detail_contents_wrap.three_col .detail_contents .inner', 3);
      return tiles('.bass_detail_01 .detail_contents_wrap.two_col .detail_contents .inner', 2);
    }
  }, false);
})();
