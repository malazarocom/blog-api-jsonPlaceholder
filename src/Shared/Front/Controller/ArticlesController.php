<?php

namespace App\Shared\Front\Controller;

use App\Blog\Post\Article\Domain\Article;
use App\Blog\Post\Article\Domain\ArticleId;
use App\Blog\Post\Article\Domain\ArticleNotFound;
use App\Blog\Post\Article\Application\GetArticlesQuery;
use App\Blog\Post\Article\Application\GetArticlesUseCase;
use App\Blog\Post\Author\Domain\AuthorNotFound;
use App\Blog\Post\Author\Application\GetArticleAuthorQuery;
use App\Blog\Post\Author\Application\GetArticleAuthorUseCase;
use App\Shared\Front\Controller\BlogBaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/blog")]
class ArticlesController extends BlogBaseController
{
    /**
     * @Route("/articles/{page}", methods={"GET"}, name="get_all_articles")
     *
     * @param GetArticlesUseCase $getArticlesUseCase
     * @param string $page
     * @return Response
     */
    public function allArticles(GetArticlesUseCase $getArticlesUseCase, string $page = "1"): Response
    {
        $query = new GetArticlesQuery();
        $articles = $getArticlesUseCase->search($query);

        return $this->response(
            'blog/index.html.twig',
            [
                'articles'      => $articles,
                'title_page'    => 'All articles',
                'page'          => $page
            ]
        );
    }

    /**
     * @Route("/articles/{articleId}", methods={"GET"}, name="article_details", requirements={"articleId"="\d+"})
     *
     * @param string $articleId
     * @param GetArticlesUseCase $getArticlesUseCase
     * @param GetArticleAuthorUseCase $getArticleAuthorUseCase
     * @return Response
     */
    public function articleDetails(
        string $articleId,
        GetArticlesUseCase $getArticlesUseCase,
        GetArticleAuthorUseCase $getArticleAuthorUseCase
    ): Response {
        $getArticleQuery = new GetArticlesQuery(new ArticleId($articleId));

        try {
            /** @var Article $article */
            $article = $getArticlesUseCase->search($getArticleQuery)->getFirst();
            $getArticleAuthorQuery = new GetArticleAuthorQuery($article->getId());
            $articleAuthor = $getArticleAuthorUseCase->search($getArticleAuthorQuery);
            $article->setAuthor($articleAuthor);

            return $this->render(
                'articles/article_detail.html.twig',
                [
                    'title' => "Blog article | #{$article->getId()->getValue()}",
                    'article' => $article,
                    'title_page' => $article->getTitle()
                ]
            );
        } catch (ArticleNotFound) {
            return $this->render(
                'errors/not_found.html.twig',
                [
                    'item_not_found' => 'Article'
                ]
            );
        } catch (AuthorNotFound) {
            return $this->render(
                'errors/not_found.html.twig',
                [
                    'item_not_found' => "Article author #{$article->getId()->getValue()}"
                ]
            );
        }
    }

    /**
     * @Route("/test", methods={"GET"}, name="get_test")
     */
    public function test(): Response
    {;

        return $this->response(
            'test.html.twig',
            [
                // 'articles'      => $articles,
                'title_page'    => 'All articles'
            ]
        );
    }
}
