import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import LoginForm from './Components/LoginForm/LoginForm';
import GeneralView from './Components/GeneralView/GeneralView';
import Welcome from './Components/Welcome/Welcome'

const MiComponente = (match) => {
  // Acceder a los parámetros de la ruta
  const { params } = match;

  // Comprobar si hay parámetros
  if (params.pass) {
    return <div>Recibí el parámetro: {params.parametro}</div>;
  } else {
    return <div>No recibí ningún parámetro</div>;
  }
};

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/:pass" element={<MiComponente />} />
        <Route path="/login" element={<LoginForm />} />
        <Route path="/general" element={<GeneralView />} />
      </Routes>
    </Router>
  );
}

export default App;

