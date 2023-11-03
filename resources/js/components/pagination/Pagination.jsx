import React from 'react';
import './Pagination.css';

const Pagination = ({ currentPage, lastPage, onPageChange }) => {
  const pageNumbersToShow = 5;
  const halfPageNumbersToShow = Math.floor(pageNumbersToShow / 2);

  const renderPageNumbers = () => {
    let pages = [];
    let startPage = Math.max(currentPage - halfPageNumbersToShow, 1);
    let endPage = Math.min(startPage + pageNumbersToShow - 1, lastPage);

    if (endPage - startPage < pageNumbersToShow - 1) {
      startPage = Math.max(endPage - pageNumbersToShow + 1, 1);
    }

    if (startPage > 1) {
      pages.push(
        <button key="startEllipses" className="page-item" disabled>
          ...
        </button>
      );
    }

    for (let i = startPage; i <= endPage; i++) {
      pages.push(
        <button
          key={i}
          onClick={() => onPageChange(i)}
          disabled={currentPage === i}
          className={`page-item ${currentPage === i ? 'active' : ''}`}
        >
          {i}
        </button>
      );
    }

    if (endPage < lastPage) {
      pages.push(
        <button key="endEllipses" className="page-item" disabled>
          ...
        </button>
      );
    }

    return pages;
  };

  return (
    <div className="pagination">
      <button onClick={() => onPageChange(1)} disabled={currentPage === 1}>
        First
      </button>
      <button onClick={() => onPageChange(currentPage - 1)} disabled={currentPage === 1}>
        Previous
      </button>
      {renderPageNumbers()}
      <button onClick={() => onPageChange(currentPage + 1)} disabled={currentPage === lastPage}>
        Next
      </button>
      <button onClick={() => onPageChange(lastPage)} disabled={currentPage === lastPage}>
        Last
      </button>
    </div>
  );
};

export default Pagination;
