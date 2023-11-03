import React from 'react';
import ReactDOM from 'react-dom/client';
import {
  BrowserRouter as Router,
  Routes,
  Route
} from 'react-router-dom';

import Header from './components/header/Header';
import Footer from './components/footer/Footer';
import Home from './components/home/Home';
import About from './components/about/About';
import NoMatch from './components/NoMatch';

import './App.css';

const root = ReactDOM.createRoot(document.getElementById('app') as HTMLElement);

root.render(
  <React.StrictMode>
    <Router>
      <Header />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="about" element={<About />} />
        <Route path="*" element={<NoMatch />} />
      </Routes>
      <Footer />
    </Router>
  </React.StrictMode>
);
