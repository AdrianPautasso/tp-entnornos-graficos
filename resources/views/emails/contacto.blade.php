<h2 style="margin:0 0 16px; font-size:20px; color:#0d6efd;">Nuevo mensaje de contacto</h2>

<p style="margin:0 0 16px;">
    Llegó una consulta desde el formulario de contacto del sitio.
</p>

<table cellpadding="8" cellspacing="0" border="0" style="border-collapse:collapse; margin-bottom:16px;">
    <tr>
        <td style="border:1px solid #dee2e6;"><strong>Nombre</strong></td>
        <td style="border:1px solid #dee2e6;">{{ $nombre }}</td>
    </tr>
    <tr>
        <td style="border:1px solid #dee2e6;"><strong>Email</strong></td>
        <td style="border:1px solid #dee2e6;">
            <a href="mailto:{{ $email }}">{{ $email }}</a>
        </td>
    </tr>
</table>

<p style="margin:0 0 8px;"><strong>Mensaje:</strong></p>

<div style="white-space:pre-wrap; border:1px solid #dee2e6; border-radius:6px; padding:12px;">{{ $mensaje }}</div>