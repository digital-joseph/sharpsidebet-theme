/* Sharpside theme JS — vanilla, no dependencies. Loaded with defer. */
(function () {
  "use strict";
  document.documentElement.classList.add("js");

  document.addEventListener("DOMContentLoaded", function () {
    // year
    var yr = document.getElementById("yr");
    if (yr) yr.textContent = new Date().getFullYear();

    // mobile menu
    var hamb = document.getElementById("hamb");
    var mmenu = document.getElementById("mmenu");
    if (hamb && mmenu) {
      hamb.addEventListener("click", function () {
        var open = mmenu.classList.toggle("open");
        hamb.setAttribute("aria-expanded", String(open));
      });
      mmenu.querySelectorAll("a").forEach(function (a) {
        a.addEventListener("click", function () {
          mmenu.classList.remove("open");
          hamb.setAttribute("aria-expanded", "false");
        });
      });
    }

    // duplicate marquees for a seamless loop
    ["marq", "marq2"].forEach(function (id) {
      var m = document.getElementById(id);
      if (m) m.innerHTML += m.innerHTML;
    });

    // scroll reveals
    if ("IntersectionObserver" in window) {
      var io = new IntersectionObserver(function (es) {
        es.forEach(function (e) {
          if (e.isIntersecting) { e.target.classList.add("in"); io.unobserve(e.target); }
        });
      }, { threshold: 0.1 });
      document.querySelectorAll(".reveal").forEach(function (el) { io.observe(el); });
    } else {
      document.querySelectorAll(".reveal").forEach(function (el) { el.classList.add("in"); });
    }

    // billing toggle (subscriptions)
    var m = document.getElementById("tMonthly"), a = document.getElementById("tAnnual");
    if (m && a) {
      function setBilling(annual) {
        m.classList.toggle("on", !annual); a.classList.toggle("on", annual);
        m.setAttribute("aria-pressed", String(!annual)); a.setAttribute("aria-pressed", String(annual));
        document.querySelectorAll(".pr[data-m]").forEach(function (p) {
          var amt = p.querySelector(".amt"); var small = p.querySelector("small");
          if (amt) amt.textContent = annual ? p.dataset.a : p.dataset.m;
          if (small) small.textContent = annual ? "/mo, billed yearly" : "/mo";
        });
        document.querySelectorAll(".annual[data-annual]").forEach(function (el) {
          el.textContent = annual ? el.dataset.annual : " ";
        });
      }
      m.addEventListener("click", function () { setBilling(false); });
      a.addEventListener("click", function () { setBilling(true); });
    }

    // track-record: log filter (All / Wins / Losses / Passes)
    var fbar = document.querySelector(".filterbar");
    if (fbar) {
      var rows = Array.prototype.slice.call(document.querySelectorAll("table.log tbody tr"));
      fbar.querySelectorAll("button").forEach(function (b) {
        b.addEventListener("click", function () {
          fbar.querySelectorAll("button").forEach(function (x) { x.classList.remove("on"); });
          b.classList.add("on");
          var f = b.getAttribute("data-filter");
          rows.forEach(function (r) {
            r.style.display = (f === "all" || r.getAttribute("data-result") === f) ? "" : "none";
          });
        });
      });
    }

    // trends: filter cards by type
    var tbar = document.querySelector(".trend-toolbar");
    if (tbar) {
      var cards = Array.prototype.slice.call(document.querySelectorAll(".tcard"));
      tbar.querySelectorAll("button").forEach(function (b) {
        b.addEventListener("click", function () {
          tbar.querySelectorAll("button").forEach(function (x) { x.classList.remove("on"); });
          b.classList.add("on");
          var f = b.getAttribute("data-type");
          cards.forEach(function (c) {
            c.style.display = ( f === "all" || c.getAttribute("data-type") === f ) ? "" : "none";
          });
        });
      });
    }

    // track-record: cumulative-units equity curve
    var eq = document.getElementById("equity");
    if (eq && eq.getContext) {
      var ctx = eq.getContext("2d");
      function drawEquity() {
        var dpr = window.devicePixelRatio || 1, w = eq.clientWidth, h = 260;
        eq.width = w * dpr; eq.height = h * dpr; ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        ctx.clearRect(0, 0, w, h);
        var pad = 8, n = 90, pts = [], v = 0, seed = 11;
        function rnd() { seed = (seed * 9301 + 49297) % 233280; return seed / 233280; }
        for (var i = 0; i < n; i++) { v += (rnd() - 0.4) * 1.6; if (v < -3) v = -3; pts.push(v); }
        var min = Math.min.apply(null, pts), max = Math.max.apply(null, pts), rng = (max - min) || 1;
        ctx.strokeStyle = "rgba(38,38,42,.9)"; ctx.lineWidth = 1;
        for (var g = 0; g <= 4; g++) { var yy = pad + (h - 2 * pad) * g / 4; ctx.beginPath(); ctx.moveTo(0, yy); ctx.lineTo(w, yy); ctx.stroke(); }
        function X(i) { return pad + (w - 2 * pad) * i / (n - 1); }
        function Y(val) { return pad + (h - 2 * pad) * (1 - (val - min) / rng); }
        var grad = ctx.createLinearGradient(0, 0, 0, h);
        grad.addColorStop(0, "rgba(89,214,100,.30)"); grad.addColorStop(1, "rgba(89,214,100,0)");
        ctx.beginPath(); ctx.moveTo(X(0), Y(pts[0]));
        for (var i2 = 1; i2 < n; i2++) ctx.lineTo(X(i2), Y(pts[i2]));
        ctx.lineTo(X(n - 1), h); ctx.lineTo(X(0), h); ctx.closePath(); ctx.fillStyle = grad; ctx.fill();
        ctx.beginPath(); ctx.moveTo(X(0), Y(pts[0]));
        for (var i3 = 1; i3 < n; i3++) ctx.lineTo(X(i3), Y(pts[i3]));
        ctx.strokeStyle = "#59D664"; ctx.lineWidth = 2.5; ctx.lineJoin = "round"; ctx.stroke();
        ctx.beginPath(); ctx.arc(X(n - 1), Y(pts[n - 1]), 4.5, 0, 7); ctx.fillStyle = "#59D664"; ctx.fill();
      }
      drawEquity(); window.addEventListener("resize", drawEquity);
    }
  });
})();
