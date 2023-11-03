export interface Article {
    id: number;
    title: string;
    author: string;
    description: string;
    source_name: string;
    source_url: string;
    image_url: string;
    published_at: string;
    created_at: string;
    updated_at: string;
    content?: string;
}
