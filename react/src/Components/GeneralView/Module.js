import React from 'react';

const Module = ({ module, startDrag }) => (
  <div className="mod" draggable onDragStart={(evt) => startDrag(evt, module)}>
    <p>{module.name}</p>
    <p>{module.hours}h</p>
  </div>
);

export default Module;
