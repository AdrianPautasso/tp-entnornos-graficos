/* Check 20: validación de formularios en el cliente (JavaScript).
   Genérico: aplica a CADA <form> de la app (login, registro, altas,
   edición, contacto). No requiere build: se sirve estático desde
   /js/app.validation.js (el layout ya lo referencia vía asset).
   - Bloquea el envío si algún campo required está vacío.
   - Marca ::is-invalid + invalid-feedback (compatible con el CSS de Bootstrap
     y con el asterisco del check 21).
   - Ignora campos dentro de contenedores ocultos (p. ej. el div #showLocal
     que solo se muestra para dueños). */
(function () {
    'use strict';

    function visible(el) {
        for (var p = el; p && p !== document; p = p.parentElement) {
            var s = p.style && window.getComputedStyle(p);
            if (s && (s.display === 'none' || s.visibility === 'hidden')) return false;
        }
        return true;
    }

    function marcar(campo, invalido) {
        campo.classList.toggle('is-invalid', invalido);
        var grupo = campo.closest('.mb-3, .mb-2, .form-group');
        var feedback = grupo && grupo.querySelector('.invalid-feedback');
        if (feedback) feedback.style.display = invalido ? 'block' : 'none';
    }

    var sel = 'input[required], select[required], textarea[required]';

    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (!form || form.tagName !== 'FORM') return;

        var hubs = form.querySelectorAll(sel);
        var primeroInv = null;
        var hayError = false;

        hubs.forEach(function (el) {
            if (!visible(el)) return;
            var vacio = !(el.value && el.value.trim());
            if (el.type === 'checkbox' && !el.checked) vacio = true;
            if (vacio) {
                marcar(el, true);
                hayError = true;
                if (!primeroInv) primeroInv = el;
            } else {
                marcar(el, false);
            }
        });

        if (hayError) {
            e.preventDefault();
            e.stopPropagation();
            form.classList.remove('was-validated'); /* que nuestro error no compita con el de Bootstrap */
            if (primeroInv) primeroInv.focus();
        }
    });

    /* quitar la marca apenas el usuario escribe (evita que quede pegado) */
    document.addEventListener('input', function (e) {
        var el = e.target;
        if (!el || !el.matches || !el.matches(sel)) return;
        if (el.value && el.value.trim()) marcar(el, false);
    });
})();
