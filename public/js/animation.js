const elementAnimationDashboard = document.querySelectorAll('.animation');


elementAnimationDashboard.forEach((Element)=>{
    Element.classList.remove('opacity-0', '-translate-y-8');
    Element.classList.add('opacity-100', 'translate-y-0'); 
})

