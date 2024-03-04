import React, { useState, useEffect } from 'react';
import Module from './Module.js';
import Teacher from './Teacher.js';
import logoGeneralView from '../Assets/lm_ico.svg'
import './GeneralView.css';

const GeneralView = () => {

    /* ------------------------------ ESTADOS ------------------------------ */


    /* Este estado controla la visibilidad del área de chat. Si chatVisible es true, 
    el área de chat se muestra; de lo contrario, se oculta. El valor inicial es false.*/

    const [chatVisible, setChatVisible] = useState(false);


    /* Es un array que contiene los mensajes del chat. Se utiliza para almacenar y 
    mostrar los mensajes enviados por los usuarios.*/

    const [messages, setMessages] = useState([]);


    /* Este estado guarda el contenido del nuevo mensaje que el usuario está escribiendo 
    en el área de entrada del chat.*/

    const [newMessage, setNewMessage] = useState('');


    /* Este estado controla el estado del botón que cambia entre las flechas hacia arriba y 
    hacia la derecha. Si isButtonExpanded es true, el botón muestra la flecha hacia la derecha; 
    de lo contrario, muestra la flecha hacia arriba. Se utiliza para cambiar dinámicamente el 
    icono del botón.*/

    const [isButtonExpanded, setButtonExpanded] = useState(false);


    /* Almacena el nombre de usuario. */

    const [username, setUsername] = useState('');


    /* Este estado se utiliza para comprobar si el modal está abierto o cerrado. */

    const [isModalOpen, setModalOpen] = useState(false);


    /* Estado que almacena el nombre del profesor seleccionado. */

    const [selectedTeacher, setSelectedTeacher] = useState('');


    /* Estado que almacena las horas disponibles o restantes para un profesor. */

    const [teacherHours, setTeacherHours] = useState(0);


    const [deletedLessons, setDeletedLessons] = useState([]);

    /* Estado que almacena la información de varios módulos. */

    const [modules, setModules] = useState([
        { id: 1, name: 'DIWEB', hours: 8 },
        { id: 2, name: 'DWES', hours: 8 },
        { id: 3, name: 'DWEC', hours: 6 },
        { id: 4, name: 'DEAW', hours: 3 },
        { id: 5, name: 'EIE', hours: 3 },
        { id: 6, name: 'HLC', hours: 2 },
        { id: 7, name: 'BDD', hours: 2 },
        { id: 8, name: 'FOL', hours: 2 },
        { id: 9, name: 'PGR', hours: 2 },
    ]);


    /* Estado que almacena la información de varios profesores. */

    const [teachers, setTeachers] = useState([
        { id: 1, name: 'MODESTO', hoursCompleted: 0, maxHours: 20 },
        { id: 2, name: 'CARMELO', hoursCompleted: 0, maxHours: 20 },
        { id: 3, name: 'RAUL', hoursCompleted: 0, maxHours: 20 },
        { id: 4, name: 'FERNANDO', hoursCompleted: 0, maxHours: 20 },
        { id: 5, name: 'EVA MARIA', hoursCompleted: 0, maxHours: 20 },
        { id: 6, name: 'RUTH', hoursCompleted: 0, maxHours: 20 },
        { id: 7, name: 'MONSTE', hoursCompleted: 0, maxHours: 20 },
        { id: 8, name: 'LOURDES', hoursCompleted: 0, maxHours: 20 },
    ]);




    /* ------------------------------ FUNCIONES Y MANEJO DE ESTADOS ------------------------------ */



    /* Se utiliza useEffect para obtener el valor de 'p' después de que el componente se monte */


    useEffect(() => {
        // Obtener el elemento 'p' del usuario
        const usuarioElement = document.querySelector('.usuario p');

        // Verificar si el elemento existe y establecer el estado username
        if (usuarioElement) {
            setUsername(usuarioElement.textContent || usuarioElement.innerText);
        }
    }, []);



    /* Cambiar el estado de visibilidad del área de chat */


    const toggleChat = () => {
        // Cambia el estado chatVisible al negar su valor actual. 
        setChatVisible(!chatVisible);

        // Cambia el estado isButtonExpanded al negar su valor actual
        setButtonExpanded(!isButtonExpanded);
    };



    /* Se encarga de manejar el envío de mensajes en el chat. */


    const handleSendMessage = () => {
        // Comprueba si el contenido del nuevo mensaje no es una cadena vacía
        if (newMessage.trim() !== '') {
            //  Crea un nuevo objeto de mensaje con dos propiedades: username y content
            const newMessageObject = {
                username: username,
                content: newMessage,
            };
            // Utiliza el estado setMessages para actualizar la lista de mensajes. 
            setMessages([...messages, newMessageObject]);
            // Después de enviar el mensaje con éxito, establece el estado newMessage en una cadena vacía.
            setNewMessage('');
        }
    };




    /* Se encarga de realizar varias tareas relacionadas con la apertura del 
    modal y la actualización de estados basados en el profesor seleccionado. */



    const openModal = (teacher) => {
        // Establece el estado isModalOpen en true, lo que indica que el modal debe estar abierto.
        setModalOpen(true);
        // Establece el estado selectedTeacher con el nombre del profesor seleccionado.
        setSelectedTeacher(teacher);

        // Obtener todos los elementos con la clase 'tea'
        const teacherElements = document.querySelectorAll('.tea');

        // Iterar sobre los elementos para encontrar el correspondiente al profesor seleccionado
        teacherElements.forEach((element) => {
            const teacherName = element.querySelector('p:first-child').textContent;

            // Comparar los nombres y actualizar el estado si es el profesor correcto
            if (teacherName === teacher.toUpperCase()) {
                const hoursText = element.querySelector('.horasCompletadas');
                // Convierte el contenido del elemento de horas completadas a un número entero.
                const currentHours = parseInt(hoursText.textContent || hoursText.innerText, 10);
                // Verifica si currentHours es un número válido. Si es así, establece teacherHours en la 
                // diferencia entre 20 y las horas actuales. 
                if (!isNaN(currentHours)) {
                    setTeacherHours(20 - currentHours);
                } else {
                    setTeacherHours(0);
                }
            }
        });
    };



    /* Cambiar el estado para indicar que el modal debe cerrarse. */


    const closeModal = () => {
        setModalOpen(false);
    };



    /* ------------- ARRASTRAR Y SOLTAR ------------- */

    /* ------------- INICIO ------------- */

    /**
    * Manipula el evento de inicio de arrastre de un módulo.
    * @param {Event} evt - El evento de inicio de arrastre.
    * @param {Object} module - El módulo que se está arrastrando.
    */
    const startDrag = (evt, module) => {
        // Establece los datos del módulo que se está arrastrando en el evento de transferencia de datos.
        evt.dataTransfer.setData('moduleID', module.id);

        // Imprime en la consola la información del módulo (puedes eliminar esto en producción).
        console.log(module);
    };


    /* ------------- SOBRE ------------- */

    /**
     * Manipula el evento de arrastre sobre un elemento.
     * @param {Event} evt - El evento de arrastre.
     */

    const draggingOver = (evt) => {
        evt.preventDefault();
    }



    /* ------------- SOLTAR ------------- */

    /**
    * Manipula el evento de soltar un módulo sobre un profesor.
    * @param {Event} evt - El evento de soltar.
    * @param {number} teacherId - El ID del profesor en el que se soltó el módulo.
    */

    const onDrop = (evt, teacherId) => {
        // Evitar el comportamiento predeterminado del navegador al soltar
        evt.preventDefault();

        // Obtener el ID del módulo desde los datos transferidos durante el arrastre
        const moduleID = evt.dataTransfer.getData('moduleID');

        // Buscar el módulo en la lista de módulos que coincide con el moduleID obtenido del arrastre
        const draggedModule = modules.find((module) => module.id === parseInt(moduleID, 10));

        // Buscar el profesor en la lista de profesores que coincide con el teacherId proporcionado
        const teacher = teachers.find((t) => t.id === teacherId);

        // Verificar si el profesor y el módulo existen
        if (draggedModule && teacher) {
            // Calcular las horas totales después de agregar las horas del módulo al profesor
            const totalHours = teacher.hoursCompleted + draggedModule.hours;

            // Verificar si el total de horas excede el límite máximo de 20 horas
            if (totalHours <= teacher.maxHours) {
                // Sumar las horas del módulo al total del profesor
                const updatedTeacher = { ...teacher, hoursCompleted: totalHours };

                const updatedModules = modules.filter((m) => m.id !== draggedModule.id);

                // Obtener las lecciones eliminadas
                const deletedLesson = { ...draggedModule, teacherId };

                
                // Actualizar la lista de profesores
                const updatedTeachers = teachers.map((t) =>
                    t.id === teacherId ? updatedTeacher : t
                );

                // Actualizar el estado de las lecciones eliminadas
                setDeletedLessons([...deletedLessons, deletedLesson]);
                setTeachers(updatedTeachers);
                setModules(updatedModules);
            } else {
                // Si el total de horas excede el límite máximo, asignar solo las horas disponibles hasta el límite máximo
                const availableHours = teacher.maxHours - teacher.hoursCompleted;
                if (availableHours > 0) {
                    const updatedTeacher = { ...teacher, hoursCompleted: teacher.maxHours };

                    const updatedModules = modules.map((m) =>
                        m.id === moduleID ? { ...m, hours: m.hours - availableHours } : m
                    );

                    const updatedTeachers = teachers.map((t) =>
                        t.id === teacherId ? updatedTeacher : t

                    );

                    setTeachers(updatedTeachers);
                    setModules(updatedModules);
                }
            }
            
        }
    };

    const handleKeyPress = (e) => {
        if (e.key === 'Enter') {
            handleSendMessage();
        }
    };

    /* ------------------------------ ESTRUCTURA ------------------------------ */


    return (
        <div className="container">
            <div className="header">
                <div className="div1">
                    <h2>Módulos</h2>
                </div>
                <div className="div2">
                    <div className="goadmin">
                        <a href="http://localhost:8800" target='_blank'>Go admin</a>
                    </div>
                    <div className="logo-header-general-view">
                        <img src={logoGeneralView} alt="logo" />
                    </div>
                    <div className="usuario" onClick={(e) => openModal(e.currentTarget.querySelector('p').textContent)}>
                        <p>Carmelo</p>
                    </div>
                </div>
                <div className="div3">
                    <h2>Profesores</h2>
                </div>
            </div>

            <div className="modulos">
                {modules.map((module) => (
                    <Module key={module.id} module={module} startDrag={startDrag} />
                ))}
            </div>
            <div className="modals">
                <div className="alerts">
                    {isModalOpen && (
                        <div className="modal">
                            {/* Contenido del modal */}
                            <h3>Profesor: {selectedTeacher}</h3>
                            <p>HORAS RESTANTES: {teacherHours}</p>
                            <p>LISTA LECCIONES: </p>
                            <ul>
                                {deletedLessons.map((lesson) => (
                                    <li>{lesson.name}</li>
                                ))}
                            </ul>
                            <button onClick={closeModal}>Cerrar Modal</button>
                        </div>
                    )}
                </div>

                <div className={`chat ${chatVisible ? 'expanded' : ''}`}>
                    <div className="chat_header">
                        <h2>Chat</h2>
                        <div className="btn-chat" onClick={toggleChat}>
                            {isButtonExpanded ? (
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            ) : (
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                    <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                                </svg>
                            )}
                        </div>
                    </div>
                    {chatVisible && (
                        <div className="chat-interface">
                            <div className={`messages ${chatVisible ? 'show' : ''}`}>
                                {messages.map((message, index) => (
                                    <p key={index}><strong>{message.username}:</strong> {message.content}</p>
                                ))}
                            </div>
                            {chatVisible && (
                                <div className="input-box">
                                    <input
                                        type="text"
                                        value={newMessage}
                                        onChange={(e) => setNewMessage(e.target.value)}
                                        onKeyDown={handleKeyPress}  // Agregado para manejar la tecla "Enter"
                                        placeholder="Escribe tu mensaje..."
                                    />
                                    <button onClick={handleSendMessage}>Enviar</button>
                                </div>
                            )}
                        </div>
                    )}
                </div>
            </div>

            <div className="teachers">
                {teachers.map((teacher) => (
                    <Teacher
                        key={teacher.id}
                        teacher={teacher}
                        startDrag={startDrag}
                        draggingOver={draggingOver}
                        onDrop={onDrop}
                        openModal={openModal}
                    />
                ))}
            </div>

        </div>
    );
};

export default GeneralView;
