document.addEventListener('DOMContentLoaded', function () {

    $('.phone')
        .mask('+375 (00) 000-00-00', {
            clearIfNotMatch: true
        })
        .on('focus', function () {
            if ($(this).val().trim() === '') {
                $(this).attr('placeholder', '+375 (__) ___-__-__');
            }
        })
        .on('blur', function () {
            if ($(this).val().trim() === '') {
                $(this).attr('placeholder', 'Телефон*');
            }
        });

    const jsOpenPopUp = document.querySelectorAll('.js_btn');
    const jsClosePopUp = document.querySelectorAll('.btn_close');
    const form = document.querySelector('.pop_container');
    const formCheck = document.querySelector('.pop-up__form');
    const submitBtn = document.querySelectorAll('.pop-up__submit_btn');

    function pushData(e) {
        e.preventDefault();

        const btn = e.target;
        const form = btn.closest('form');
        const result = document.querySelector('.pop-up__form .result');
        result.textContent = '';

        const inputs = form.querySelectorAll('input');

        for (const input of inputs) {
            if (input.value.trim() === '') {
                result.textContent = 'Заполните все поля!';
                return;
            }
        }
        const formData = new FormData(form);

        btn.disabled = true;
        btn.textContent = 'Идет отправка...';

        fetch('/ajax/save_form.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    form.style.display = 'none';
                    result.textContent = 'Спасибо, мы с Вами свяжемся!';
                    form.reset();
                } else {
                    result.textContent = 'Ошибка: ' + (data.errors?.join(', ') || 'Ошибка при отправке');
                }
            })
            .catch(error => {
                result.textContent = 'Ошибка отправки: ' + error;
            })
            .finally(() => {
                btn.disabled = true;
                btn.textContent = 'Сохранить';
            })
    }

    function openPopUp() {
        form.classList.add('open');
    }

    function closePopUp() {
        form.classList.remove('open');
    }

    jsOpenPopUp.forEach(btn => btn.addEventListener('click', openPopUp));

    jsClosePopUp.forEach(btn => btn.addEventListener('click', closePopUp));

    document.addEventListener('click', (e) => {
        if (!formCheck.contains(e.target) && !Array.from(jsOpenPopUp).some(btn => btn.contains(e.target))) {
            closePopUp();
        }
    });

    submitBtn.forEach(btn => btn.addEventListener('click', pushData));
});