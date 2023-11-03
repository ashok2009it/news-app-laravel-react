import React from 'react';
import { Link } from 'react-router-dom';

const NoMatch = () => {
  return (
    <div>
      <h1>404 Not Found</h1>
      <p>No match for this page.</p>
      <Link to="/">Go back to the homepage</Link>
    </div>
  );
};

export default NoMatch;
