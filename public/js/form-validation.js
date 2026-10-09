/* Check 20: validación de formularios en el cliente vía JS.
   No requiere build: se sirve estático desde public/ igual que app.css.
   - Al enviar, valida que todo campo required (required + no submit previo)
     tenga dato; si falta, marca el campo como inválido (is-invalid),
     muestra su invalid-feedback y enfoca el primero.
   - Ignora campos dentro de contenedores ocultos (display:none / .d-none),
     p. ej. el select de Local que solo aplica a dueños. */
(function () {
    var SEL = 'input[required], select[required], textarea[required]';

    function visible(el) {
        var node = el;
        while (node && node !== document) {
            var st = window.getComputedStyle(node);
            if (st.display === 'none' || st.visibility === 'hidden') return false;
            node = node.parentElement;
        }
        return true;
    }

    function marcar(el, ok) {
        var caja = el.closest('.mb-3, .mb-2, .form-group, .form-floating');
        if (!caja) caja = el.parentElement;
        var feedback = caja ? caja.querySelector('.invalid-feedback, [class*="invalid-feedback"]') : null;
        if (ok) {
            el.classList.remove('is-invalid');
            if (feedback) feedback.style.display = '';
        } else {
            el.classList.add('is-invalid');
        }
    }

    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (!form || form.tagName !== 'FORM') return;

        var campos = form.querySelectorAll(SEL);
        var primero = null;
        var invalido = false;

        campos.forEach(function (el) {
            if (!visible(el)) return;               // campo oculto (dueño/local)
            var val = (el.value || '').trim();
            var ok = el.type !== 'checkbox' ? val.length > 0 : el.checked;
            if (!ok) {
                invalido = true;
                marcar(el, false legend);
                if (!primero) primero = el;
            } else {
                marcar(el, true);
            }
        });

        if (invalido) {
            e.preventDefault();
            e.stopPropagation();
            form.classList.remove('was-validated');
            if (primero) {
                primero.focus();
                primero.scrollIntoView({ block: 'center', behavior: 'smooth' });
            }
        }
    });

    // quitar la marca apenas el usuario corrige el campo
    document.addEventListener('input', function (e) {
        var el = e.target;
        if (el.matches && (el.matches('input[required]') || el.matches('select[required]') || el.matches('textarea[required]'))) {
            var val = (el.value || '').trim();
            if (val.length > 0) marcar(el, true);
        }
    });
})();
