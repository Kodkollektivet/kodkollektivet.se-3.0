<section id="banner">
  <div class="inner" style="text-align: center">
    <img src="{{ URL::asset('img/logo.svg') }}" style="width: 200px" alt="">
    <h1 style="border-bottom: solid 1px rgba(255, 255, 255, 1) !important;">{{ $titl }}</h1>
    <div style="display:flex; justify-content: center">
      <p>{{ $desc }}</p>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
<script>

// Render interactive BG.
VANTA.NET({
  el: "#banner",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  scale: 1.00,
  scaleMobile: 1.00,
  color: 0xaaccee,
  backgroundColor: 0xffffff
})

</script>