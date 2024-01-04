<?php

class MY_Model extends CI_Model
{

    private $table;

    private $return_type = 'array';

    public function  __construct()
    {
        parent::__construct();
    }

    public function table_exists( $tabela = false )
    {
        $ret = $this->db->table_exists( ($tabela) ? $this->table : $tabela );

        return $ret;
    }

    public function set_table( $table )
    {
        $this->table = $table;
    }

    public function set_return( $tipo )
    {
        switch( $tipo ):

            case 'object':
                $this->return_type = $tipo;
            break;

            case 'row':
                $this->return_type = $tipo;
            break;

            default:
                $this->return_type = 'array';

        endswitch;
    }

    public function update( $data, $where )
    {
        $this->db->where( $where );
        $ret = $this->db->update( $this->table, $data );

        return $ret;
    }

    public function insert( $data, $return_id = false )
    {
        $ret = false;

        if( $return_id )
        {
            $this->db->insert( $this->table, $data );
            $ret = $this->db->insert_id();
        }
        else
            $ret = $this->db->insert( $this->table, $data );

        return $ret;
    }

    public function get( $fields = array(), $where = NULL, $orderby = NULL, $ini = NULL, $off = NULL, $like = NULL )
    {
        $this->db->from( $this->table );

        $qtd_fields = is_array($fields) ? count($fields) : 0;
        if( $qtd_fields > 0 )
          $this->db->select( implode(', ', array_values($fields)) );

        ( ! is_null($where) && is_array($where) ) ? $this->db->where( $where ) : NULL;
        ( ! is_null($off) && ! is_null($ini) ) ? $this->db->limit( $ini, $off ) : NULL;
        ( ! is_null($orderby) ) ? $this->db->order_by( $orderby ) : NULL;
        ( ! is_null($like) ) ? $this->db->like( $like ) : NULL;

        $query = $this->db->get();

        if ( $this->return_type == 'array' )
            $results = $query->result_array();
        else if( $this->return_type == 'row' )
            $results = $query->row_array();
        else
            $results = $query->result();

        $qtd = is_array($results) ? count($results) : 0;
        if( $qtd == 0 )
            return false;

        return $results;
    }

    public function delete( $where )
    {
      $this->db->where( $where );
      $ret = $this->db->delete( $this->table );

      return $ret;
    }

    public function count_results( $where, $like = false )
    {
        $this->db->where($where);

        if( $like )
            $this->db->like( $like );

        return $this->db->count_all_results( $this->table );
    }
}
