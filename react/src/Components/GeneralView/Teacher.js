import React from 'react';

const Teacher = ({ teacher, startDrag, draggingOver, onDrop, openModal }) => (
  <div
    className="tea"
    draggable
    onDragStart={(evt) => startDrag(evt, teacher)}
    onDragOver={(evt) => draggingOver(evt)}
    onDrop={(evt) => onDrop(evt, teacher.id)}
    onClick={(e) => openModal(e.currentTarget.querySelector('p:first-child').textContent)}
  >
    <p>{teacher.name}</p>
    <p className="horasCompletadas">{teacher.hoursCompleted}</p>
    <p>/</p>
    <p>{teacher.maxHours}h</p>
  </div>
);

export default Teacher;
