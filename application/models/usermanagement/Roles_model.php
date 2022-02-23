<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {
public function add($data)
{ 
    $this->db->where('name', $data['name']);
    $this->db->where('display_name',$data['display_name']);
    $query = $this->db->get('mst_roles');
    $count_row = $query->num_rows();
    if ($count_row > 0) {
       return "data already exist";
    } else 
    {
     $this->db->insert('mst_roles',$data);
     $id = $this->db->insert_id();
    return $id;
  
    }
}


public function adduserpermission($data)
{
    
    $this->db->insert('mst_role_permissions',$data);
} 
public function list()
{
$this->db->select('*');
$this->db->from('mst_roles');
$query = $this->db->get();
$result = $query->result();
return $result;
}
public function edit($id)
{
    $this->db->where('id', $id);
    $query = $this->db->get('mst_roles');
    $result = $query->result();
return $result;
}
public function update($id,$data)
{
    $this->db->where('id',$id);
        $this->db->update('mst_roles',$data);
        return "success";
    
}
public function deleterolepermission($id)
{
    $this->db->where('role_id',$id);
        $this->db->delete('mst_role_permissions');
    
}


public function updaterolepermission($data)
{
   $this->db->where('role_id',$data['role_id']);
    $this->db->insert('mst_role_permissions',$data);
}

public function list_permission($type)
{
    $this->db->SELECT('id,name,display_name')->FROM ('mst_permission')->WHERE("name LIKE '".$type."%'") ;
    $query = $this->db->get();
    $result = $query->result();
    return $result; 
}
public function list_permissionforEdit($type,$id)
{
    $query = $this->db->query("select id,display_name, case when exists(select * from mst_role_permissions where permission_id=mst_permission.id and role_id=".$id.")then true else false end as Isselected from mst_permission where  name LIKE '".$type."%'");
    
    $result = $query->result();
    return $result; 
}


}