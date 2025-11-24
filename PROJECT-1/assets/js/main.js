// Simple scroll-reveal for [data-animate]
(function(){
  const items = document.querySelectorAll('[data-animate]');
  const io = new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(e.isIntersecting) e.target.classList.add('in-view');
    });
  }, {threshold: 0.12});
  items.forEach(i=>io.observe(i));
})();

// Smooth YouTube modal handling (used by gallery & paket)
document.addEventListener('click', function(e){
  const target = e.target.closest('[data-video-src]');
  if(!target) return;
  const src = target.getAttribute('data-video-src');
  const modalId = target.getAttribute('data-bs-target') || '#modalVideo';
  const iframe = document.querySelector(modalId + ' iframe');
  if(iframe) iframe.src = src + '?autoplay=1';
});

// Clear iframe when modal hides
document.addEventListener('DOMContentLoaded', function(){
  const modals = document.querySelectorAll('.modal');
  modals.forEach(m=>{
    m.addEventListener('hidden.bs.modal', function(){
      const iframe = m.querySelector('iframe');
      if(iframe) iframe.src = '';
    });
  });
});

document.querySelectorAll('.guide-card').forEach(card => {
  card.addEventListener('click', () => {
    card.style.transition = "0.4s";
    card.style.transform = "translateY(-8px) scale(1.02)";
    setTimeout(() => {
      card.style.transform = "";
    }, 500);
  });
});
