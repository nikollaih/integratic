<!-- Modal con opciones predefinidas -->
<div id="actividadesCasaPiarModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecciona una actividad predefinida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Frecuencia</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="opcionesPredefinidas"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const opciones = [
        {
            nombre: "Rutina diaria estructurada",
            descripcion: "Establecer horarios fijos para actividades como levantarse, comer, estudiar, jugar y dormir, con anticipación visual si es posible.",
            frecuencia: "Diaria"
        },
        {
            nombre: "Refuerzo positivo en casa",
            descripcion: "Reforzar verbal o materialmente los logros escolares o comportamientos esperados del estudiante en casa.",
            frecuencia: "Diaria"
        },
        {
            nombre: "Supervisión de tareas escolares",
            descripcion: "Acompañar al estudiante en la realización de tareas, asegurando comprensión de instrucciones y cumplimiento.",
            frecuencia: "Diaria"
        },
        {
            nombre: "Agenda de comunicación con el colegio",
            descripcion: "Revisar y firmar diariamente la agenda escolar para conocer avances, dificultades y mantener contacto con docentes.",
            frecuencia: "Diaria"
        },
        {
            nombre: "Práctica de habilidades sociales",
            descripcion: "Generar espacios en casa donde se practiquen saludos, despedidas, turnos para hablar, expresión de emociones, etc.",
            frecuencia: "Semanal"
        },
        {
            nombre: "Actividades de lectura compartida",
            descripcion: "Leer juntos cuentos o libros, fomentando la comprensión y el gusto por la lectura.",
            frecuencia: "Semanal"
        },
        {
            nombre: "Uso de pictogramas o apoyos visuales en casa",
            descripcion: "Implementar imágenes o secuencias visuales para tareas del hogar como cepillarse, bañarse, recoger juguetes, etc.",
            frecuencia: "Permanente"
        },
        {
            nombre: "Participación en estrategias del PIAR",
            descripcion: "Aplicar en casa las mismas estrategias de regulación, refuerzo o apoyo utilizadas en el aula, para mantener coherencia.",
            frecuencia: "Permanente"
        },
        {
            nombre: "Establecimiento de normas claras",
            descripcion: "Definir normas y límites en casa con lenguaje sencillo y visual si es necesario, y reforzarlas con consistencia.",
            frecuencia: "Permanente"
        },
        {
            nombre: "Tiempo especial de juego o conversación",
            descripcion: "Dedicar un momento exclusivo al día o semana para jugar o hablar con el niño, promoviendo vínculo y comunicación.",
            frecuencia: "Semanal"
        },
        {
            nombre: "Registro de emociones",
            descripcion: "Invitar al niño a expresar cómo se sintió durante el día usando dibujos, pictogramas o palabras, y compartirlo con el colegio.",
            frecuencia: "Diaria"
        },
        {
            nombre: "Asistencia a reuniones escolares",
            descripcion: "Asistir puntualmente a reuniones, talleres o encuentros propuestos por el colegio para seguimiento del PIAR.",
            frecuencia: "Semanal"
        },
        {
            nombre: "Implementación de técnicas de regulación",
            descripcion: "Apoyar con respiración, masajes, pausas sensoriales o técnicas acordadas para prevenir o manejar crisis en casa.",
            frecuencia: "Diaria"
        },
        {
            nombre: "Promoción de autonomía",
            descripcion: "Permitir al estudiante realizar actividades cotidianas por sí mismo, con apoyo si es necesario (vestirse, ordenar, elegir ropa).",
            frecuencia: "Diaria"
        },
        {
            nombre: "Uso de lenguaje positivo",
            descripcion: "Utilizar frases motivadoras y evitar gritos o castigos excesivos para fortalecer el autoestima del niño.",
            frecuencia: "Permanente"
        },
        {
            nombre: "Gestión de citas médicas y terapias",
            descripcion: "Asegurar la asistencia del estudiante a controles médicos, citas de neurología, psicología, psiquiatría o terapias.",
            frecuencia: "Semanal"
        },
        {
            nombre: "Administración de medicamentos",
            descripcion: "Brindar medicamentos de acuerdo a la prescripción médica, respetando horarios y dosis.",
            frecuencia: "Diaria"
        },
        {
            nombre: "Coordinación con EPS y profesionales",
            descripcion: "Realizar los trámites necesarios para garantizar continuidad de servicios de salud, terapias y atención integral.",
            frecuencia: "Permanente"
        },
        {
            nombre: "Seguimiento de tratamientos terapéuticos",
            descripcion: "Aplicar en casa ejercicios, pautas o recomendaciones dadas por terapeutas (fonoaudiología, ocupacional, psicología, etc.).",
            frecuencia: "Diaria"
        },
    ];

    // Poblamos la tabla del modal
    const tabla = document.getElementById("opcionesPredefinidas");
    opciones.forEach((op, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
      <td>${op.nombre}</td>
      <td>${op.descripcion}</td>
      <td>${op.frecuencia}</td>
      <td><button class="btn btn-sm btn-primary seleccionar-opcion" data-index="${index}">Seleccionar</button></td>
    `;
        tabla.appendChild(row);
    });

    // Selección automática y envío del formulario
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("seleccionar-opcion")) {
            const data = opciones[e.target.dataset.index];

            document.querySelector("textarea[name='actividad']").value = data.nombre;
            document.querySelector("textarea[name='descripcion']").value = data.descripcion;
            document.querySelector("select[name='frecuencia']").value = data.frecuencia;

            $('#actividadesCasaPiarModal').modal('hide'); // cerrar el modal
        }
    });
</script>
