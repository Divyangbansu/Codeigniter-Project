<?php
class loginmodel extends CI_Model
{
    public function isvalidate($username,$password)
    {
        $q=$this->db->where(['username'=>$username,'password'=>$password])
                    ->get('admin');
        //select * from admin where username=$username and password=$password 
                if($q->num_rows())
                {
                    return $q->row()->id;
                }
                else
                {
                    return false;
                }
    }
    
    public function nlist()
    {
        $q=$this->db->select()
                ->from('nameplates')
                ->get();
        if($q->num_rows() > 0){
           return $q->result();}
        else{
            return false;
        }
            
    }
    public function blist()
    {
        $q=$this->db->select()
                ->from('banners')
                ->get();
        if($q->num_rows() > 0){
           return $q->result();}
        else{
            return false;
        }
            
    }

    public function add($data)
    {
        return $this->db->insert('nameplates',$data);
    }

    public function addbanner($data)
    {
        return $this->db->insert('banners',$data);
    }

    public function edit($id)
    {
        $query = $this->db->select('*')
                ->from('nameplates')
                ->where('id', $id)
                ->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    
    public function editbanner($id)
    {
        $query = $this->db->select('*')
                ->from('banners')
                ->where('id', $id)
                ->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update($id, $data)
    {
        return $this->db->update('nameplates', $data, array('id' => $id));
    }

    public function updatebanner($id, $data)
    {
        return $this->db->update('banners', $data, array('id' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete('nameplates', array('id' => $id));
    }

    public function deletebanner($id)
    {
        return $this->db->delete('banners', array('id' => $id));
    }

    public function updatestat($stat,$id)
    {
       return $this->db->set('status', $stat)
                    ->where('id', $id)
                    ->update('nameplates');
    }

    public function updatebannerstat($stat,$id)
    {
       return $this->db->set('status', $stat)
                    ->where('id', $id)
                    ->update('banners');
    }
}
?>