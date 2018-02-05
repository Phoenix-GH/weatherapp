<?php

namespace Doctrine\Common\Collections;

use Doctrine\Common\Collections\Expr\Expression;
use Doctrine\Common\Collections\Expr\CompositeExpression;

/**
 * Criteria for filtering Selectable collections.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 * @since 2.3
 */
class Criteria
{
    /**
     * @var string
     */
    const ASC = 'ASC';

    /**
     * @var string
     */
    const DESC = 'DESC';

    /**
     * @var \Doctrine\Common\Collections\ExpressionBuilder|null
     */
    private static $expressionBuilder;

    /**
     * @var \Doctrine\Common\Collections\Expr\Expression|null
     */
    private $expression;

    /**
     * @var string[]
     */
    private $orderings = [];

    /**
     * @var int|null
     */
    private $firstResult;

    /**
     * @var int|null
     */
    private $maxResults;

    /**
     * Creates an instance of the class.
     *
     * @return Criteria
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Returns the expression builder.
     *
     * @return \Doctrine\Common\Collections\ExpressionBuilder
     */
    public static function expr()
    {
        if (self::$expressionBuilder === null) {
            self::$expressionBuilder = new ExpressionBuilder();
        }

        return self::$expressionBuilder;
    }

    /**
     * Construct a new Criteria.
     *
     * @param Expression    $expression
     * @param string[]|null $orderings
     * @param int|null      $firstResult
     * @param int|null      $maxResults
     */
    public function __construct(Expression $expression = null, array $orderings = null, $firstResult = null, $maxResults = null)
    {
        $this->expression = $expression;

        $this->setFirstResult($firstResult);
        $this->setMaxResults($maxResults);

        if (null !== $orderings) {
            $this->orderBy($orderings);
        }
    }

    /**
     * Sets the where expression to evaluate when this Criteria is searched for.
     *
     * @param Expression $expression
     *
     * @return Criteria
     */
    public function where(Expression $expression)
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * Appends the where expression to evaluate when this Criteria is searched for
     * using an AND with previous expression.
     *
     * @param Expression $expression
     *
     * @return Criteria
     */
    public function andWhere(Expression $expression)
    {
        if ($this->expression === null) {
            return $this->where($expression);
        }

        $this->expression = new CompositeExpression(
            CompositeExpression::TYPE_AND,
            [$this->expression, $expression]
        );

        return $this;
    }

    /**
     * Appends the where expression to evaluate when this Criteria is searched for
     * using an OR with previous expression.
     *
     * @param Expression $expression
     *
     * @return Criteria
     */
    public function orWhere(Expression $expression)
    {
        if ($this->expression === null) {
            return $this->where($expression);
        }

        $this->expression = new CompositeExpression(
            CompositeExpression::TYPE_OR,
            [$this->expression, $expression]
        );

        return $this;
    }

    /**
     * Gets the expression attached to this Criteria.
     *
     * @return Expression|null
     */
    public function getWhereExpression()
    {
        return $this->expression;
    }

    /**
     * Gets the current orderings of this Criteria.
     *
     * @return string[]
     */
    public function getOrderings()
    {
        return $this->orderings;
    }

    /**
     * Sets the ordering of the result of this Criteria.
     *
     * Keys are field and values are the order, being either ASC or DESC.
     *
     * @see Criteria::ASC
     * @see Criteria::DESC
     *
     * @param string[] $orderings
     *
     * @return Criteria
     */
    public function orderBy(array $orderings)
    {
        $this->orderings = array_map(
            function (string $ordering) : string {
                return strtoupper($ordering) === Criteria::ASC ? Criteria::ASC : Criteria::DESC;
            },
            $orderings
        );

        return $this;
    }

    /**
     * Gets the current first result option of this Criteria.
     *
     * @return int|null
     */
    public function getFirstResult()
    {
        return $this->firstResult;
    }

    /**
     * Set the number of first result that this Criteria should return.
     *
     * @param int|null $firstResult The value to set.
     *
     * @return Criteria
     */
    public function setFirstResult($firstResult)
    {
        $this->firstResult = null === $firstResult ? null : (int) $firstResult;

        return $this;
    }

    /**
     * Gets maxResults.
     *
     * @return int|null
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * Sets maxResults.
     *
     * @param int|null $maxResults The value to set.
     *
     * @return Criteria
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = null === $maxResults ? null : (int) $maxResults;

        return $this;
    }
}