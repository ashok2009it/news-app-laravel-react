import React from 'react';
import { Link } from 'react-router-dom';
import './Header.css';

const Header = () => {
  return (
    <header className="header">
      <nav className="navbar">
        <Link to="/" className="nav-logo">News Aggregator</Link>
        <div className="nav-links">
          <Link to="/">Home</Link>
          <Link to="/about">About</Link>
          <Link to="/">Contact</Link>
        </div>
      </nav>
    </header>
  );
};

export default Header;
