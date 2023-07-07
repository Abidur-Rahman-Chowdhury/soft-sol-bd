<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $table = 'portfolio';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'meta_key_word', 'description'];

    public function insertPortfolio($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function insertImages($data)
    {
        $db = db_connect();
        $builder = $db->table('images');
        $builder->insertBatch($data);
    }

    public function getAllPortfolios()
    {
        $db = db_connect();
        $builder = $db->table('portfolio');
        $portfolios = $builder->get()->getResultArray();

        foreach ($portfolios as &$portfolio) {
            $portfolio['images'] = $this->getPortfolioImages($portfolio['id']);
        }

        return $portfolios;
    }

    public function getPortfolioImages($portfolioId)
    {
        $db = db_connect();
        $builder = $db->table('images');
        $builder->where('page_name', 'portfolio');
        $builder->where('page_id', $portfolioId);
        $images = $builder->get()->getResultArray();

        return $images;
    }
}
