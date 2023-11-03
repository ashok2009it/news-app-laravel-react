import React, { useState } from 'react';
import { ArticleFilters } from '../../models/filters';
import './ArticleFilter.css';

interface ArticleFilterProps {
  onFilterChange: (filters: ArticleFilters) => void;
}

const ArticleFilter: React.FC<ArticleFilterProps> = ({ onFilterChange }) => {
  const [searchTerm, setSearchTerm] = useState('');

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setSearchTerm(e.target.value);
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    onFilterChange({ search: searchTerm });
  };

  return (
    <form onSubmit={handleSubmit} className="search-form">
      <input
        type="text"
        placeholder="Search by title, author, or source"
        value={searchTerm}
        onChange={handleInputChange}
        className="search-input"
      />
      <button type="submit" className="search-button">Search</button>
    </form>
  );
};

export default ArticleFilter;
