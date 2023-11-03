import React, { useState, useEffect } from "react";
import "./Home.css";
import Pagination from "../pagination/Pagination";
import {
    fetchArticles,
    extractPaginationData,
} from "../../services/apiService";

import ArticleFilter from "../filters/ArticleFilter";
import { ArticleFilters } from "../../models/filters";
import { Article } from "../../models/article"
import { PaginationData } from "../../models/pagination"

const Home = () => {
    const [articles, setArticles] = useState<Article[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [currentPage, setCurrentPage] = useState(1);
    const [paginationData, setPaginationData] = useState<PaginationData | null>(null);

    const [filters, setFilters] = useState<ArticleFilters>({});

    useEffect(() => {
        setLoading(true);
        fetchArticles(currentPage, filters)
            .then((data) => {
                setArticles(data.data);
                setPaginationData(extractPaginationData(data));
                setLoading(false);
            })
            .catch((error) => {
                setError(error.message);
                setLoading(false);
            });
    }, [currentPage, filters]);

    const handleFilterChange = (newFilters: ArticleFilters) => {
        setFilters(newFilters);
        setCurrentPage(1);
    };

    const goToPage = (pageNumber: number) => {
        setCurrentPage(pageNumber);
    };

    if (loading) return <div className="loading">Loading...</div>;
    if (error) return <div className="error">Error: {error}</div>;

    return (
        <>
            <div className="container">
            <ArticleFilter onFilterChange={handleFilterChange} />

                <div className="home">
                    <h1>News Articles</h1>
                    <div className="articles-list">
                        {articles.map((article) => (
                            <div key={article.id} className="article">
                                <img
                                    src={article.image_url}
                                    alt={article.title}
                                    className="article-image"
                                />
                                <div className="article-content">
                                    <h2>{article.title}</h2>
                                    <p>{article.description}</p>
                                    <a
                                        href={article.source_url}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        Read more
                                    </a>
                                </div>
                            </div>
                        ))}
                    </div>

                    {paginationData  && paginationData.last_page > 1 && (
                        <Pagination
                            currentPage={currentPage}
                            lastPage={paginationData.last_page}
                            onPageChange={goToPage}
                        />
                    )}
                </div>
            </div>
        </>
    );
};

export default Home;
