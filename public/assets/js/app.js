(function() {
    const menuToggle = document.querySelector('.menu-toggle');
    menuToggle.onclick = function(e) {
        const body = document.querySelector('body');
        body.classList.toggle('hide-sidebar');
    };
})();
function activeClock() {
    //Pegando o elemento que tem a prorpriedade personalizada active-clock
    //Ex: 08:00:00 => ['08', '00', '00']
    const activeClock = document.querySelector('[active-clock]');
    if (!activeClock) return;
    function addOneSecond(hours, minutes, seconds) {
        const d = new Date();
        d.setHours(parseInt(hours));
        d.setMinutes(parseInt(minutes));
        d.setSeconds(parseInt(seconds) + 1);
        //Método padStart força o retorno de getHours a ter 2 digitos completando com 0 a esquerda caso necessário
        const h = `${d.getHours()}`.padStart(2, 0);
        const m = `${d.getMinutes()}`.padStart(2, 0);
        const s = `${d.getSeconds()}`.padStart(2, 0);
        return `${h}:${m}:${s}`;
    }
    setInterval(function() {
        //Pegando o horário contido no elemento e quebrando em horas, minutos e segundos
        const parts = activeClock.innerHTML.split(':');
        activeClock.innerHTML = addOneSecond(...parts);
    }, 1000);
}
activeClock();