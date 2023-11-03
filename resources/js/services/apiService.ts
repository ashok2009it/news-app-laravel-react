import { ArticleFilters } from '../models/filters';

interface PaginationData {
    current_page: number;
    last_page: number;
    next_page_url: string | null;
    prev_page_url: string | null;
  }

  interface ApiResponse {
    data: any[];
  }

  export const fetchArticles = async (page: number, filters: ArticleFilters): Promise<ApiResponse> => {
    const queryParams = new URLSearchParams({
      page: page.toString(),
      ...filters
    });

    try {
      const response = await fetch(`http://localhost:8000/api/articles?${queryParams}`);

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data: ApiResponse = await response.json();
      return data;
    } catch (error) {
      throw error;
    }
  };

  export const extractPaginationData = (data: any): PaginationData => {
    const { current_page, last_page, next_page_url, prev_page_url } = data;
    return { current_page, last_page, next_page_url, prev_page_url };
  };
