<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Moffice extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // List

    function getListOfficeCategories() {

        $query = $this->db->get('office_categories');
        $return = array();

        foreach ($query->result() as $category) {
            $return[$category->id_categories] = $category;
            $return[$category->id_categories]->subs = $this->getListOfficeSubcategories($category->id_categories); // Get the categories sub categories
        }

        return $return;
    }

    function getListOfficeSubcategories($id_office_categories) {
        $this->db->where('fk_office_categories', $id_office_categories);
        $query = $this->db->get('office_subcategories');
        return $query->result();
    }

    function getListOfficeTypes() {

        $this->db->from('office_types');
        $this->db->order_by("orderby", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    function getListOfficeClients() {
        $baseurl = base_url();
        $sql = "select id_clients,name_clients ,phone_clients, name_categories,date_clients,textclass_categories,icon_categories,refby_clients,fk_categories,cnic_clients
                    from office_clients oc join office_categories ct where oc.fk_categories = ct.id_categories ";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) {
            $id = $row['id_clients'];
            $var = '<button class="btn btn-muted" data-toggle="modal" data-target="#phoneModal"><i class="fas fa-phone text-muted"></i></button>
                        <a  href="' . $baseurl . 'office/deleteofficeclients/' . $id . '"><button class="btn btn-muted"><i class="fas fa-trash-alt text-danger"></i></button></a>';
            $i++;

            $query[$key]['action'] = $var;
        }
        $data['records'] = $query;
        return $data;
    }

    function getListOfficeRequests($seg3, $seg4,$seg5,$seg6) { {
            $baseurl = base_url();


            $sql = "select r.byteam,r.updated_date as updateddtae ,sc.id_categories as idreqstatus ,r.id_requests ,c.id_clients,c.refby_clients as refid,ct.id_categories as maincateid ,r.date_requests as reqdate,c.name_clients as clientname , ct.name_categories as maincatename , s.name_subcategories as subcatename , t.name as typename , ci.name as cityname , sy.name as socityname , sc.name_categories as statuscatename ,  rcate.name_categories as reqcatename,rcate.id_categories as idreqcate , r.note as reqnote , sc.bg_colour as statuscatebgcolour , sc.class_categories as statuscateclassname , rcate.bg_colour as reqcatebgcolour,  rcate.class_categories as reqcateclassname , r.address_clients as reqaddress
                   from office_requests r join office_clients c join office_subcategories s join office_categories ct join office_types t join cities ci join countries cu join societies sy join status_categories sc join req_categories rcate 
                    where r.fk_office_clients = c.id_clients and s.id_subcategories = r.fk_office_subcategories and ct.id_categories = s.fk_office_categories and rcate.id_categories = r.fk_reqcategory and t.id = r.fk_office_types and ci.id = r.fk_city and cu.id = ci.fk_countries and sy.id = r.fk_society and sc.id_categories = r.fk_status";

            if ($seg3 == "bymaincate" && $seg5 == NULL) {
                $sql .= " AND ct.id_categories = $seg4";
            }
            elseif($seg3 == "bymaincate" && $seg5 == "bystatus"){
                $sql .= " AND ct.id_categories = $seg4 AND r.fk_status = $seg6";
            }
            elseif ($seg3 == "bysubcate" && $seg5 == NULL) {
                $sql .= " AND s.id_subcategories = $seg4";
            }
            elseif ($seg3 == "bysubcate" && $seg5 == "bystatus") {
                $sql .= " AND s.id_subcategories = $seg4 AND r.fk_status = $seg6";
            }
            elseif ($seg3 == "byclient") {
                $sql .= " AND c.id_clients = $seg4";
            } elseif ($seg3 == "bystatus") {
                $sql .= " AND r.fk_status = $seg4";
            } elseif ($seg3 == "quotations") {

                $sql .= " AND rcate.id_categories = 2";
            }
            
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) {
                $id = $row['id_requests'];
                $var = '<button type="button" class="btn btn-info editbutton"><i class="icon-settings"></i></button> | <a href="' . $baseurl . 'office/deleterequest/' . $id . '/" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
                $i++;

                $query[$key]['action'] = $var;
            }
            $data['records'] = $query;
            return $data;
        }
    }

    function getListQuotaionsRequests($seg2, $seg3, $seg4,$seg5,$seg6) { {
            $baseurl = base_url();


            $sql = "select r.byteam, r.updated_date as updateddtae ,sc.id_categories as idreqstatus ,r.id_requests ,c.id_clients,c.refby_clients as refid,ct.id_categories as maincateid ,r.date_requests as reqdate,c.name_clients as clientname , ct.name_categories as maincatename , s.name_subcategories as subcatename , t.name as typename , ci.name as cityname , sy.name as socityname , sc.name_categories as statuscatename ,  rcate.name_categories as reqcatename,rcate.id_categories as idreqcate , r.note as reqnote , sc.bg_colour as statuscatebgcolour , sc.class_categories as statuscateclassname , rcate.bg_colour as reqcatebgcolour,  rcate.class_categories as reqcateclassname , r.address_clients as reqaddress
                   from office_requests r join office_clients c join office_subcategories s join office_categories ct join office_types t join cities ci join countries cu join societies sy join status_categories sc join req_categories rcate 
                    where r.fk_office_clients = c.id_clients and s.id_subcategories = r.fk_office_subcategories and ct.id_categories = s.fk_office_categories and rcate.id_categories = r.fk_reqcategory and t.id = r.fk_office_types and ci.id = r.fk_city and cu.id = ci.fk_countries and sy.id = r.fk_society and sc.id_categories = r.fk_status";


            if ($seg2 == "quotations") {

                $sql .= " AND rcate.id_categories = 2";

                if ($seg3 == "bymaincate" && $seg5 == NULL) {
                $sql .= " AND ct.id_categories = $seg4";
                }
                 elseif($seg3 == "bymaincate" && $seg5 == "bystatus"){
                $sql .= " AND ct.id_categories = $seg4 AND r.fk_status = $seg6";
                }
                elseif ($seg3 == "bysubcate" && $seg5 == NULL) {
                $sql .= " AND s.id_subcategories = $seg4";
                }
                 elseif ($seg3 == "bysubcate" && $seg5 == "bystatus") {
                $sql .= " AND s.id_subcategories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bystatus") {
                    $sql .= " AND r.fk_status = $seg4";
                }
            } elseif ($seg2 == "meetings") {

                $sql .= " AND rcate.id_categories = 1";

                if ($seg3 == "bymaincate" && $seg5 == NULL) {
                $sql .= " AND ct.id_categories = $seg4";
                }
                 elseif($seg3 == "bymaincate" && $seg5 == "bystatus"){
                $sql .= " AND ct.id_categories = $seg4 AND r.fk_status = $seg6";
                } elseif ($seg3 == "bysubcate" && $seg5 == NULL) {
                $sql .= " AND s.id_subcategories = $seg4";
                }
                 elseif ($seg3 == "bysubcate" && $seg5 == "bystatus") {
                $sql .= " AND s.id_subcategories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bystatus") {
                    $sql .= " AND r.fk_status = $seg4";
                }
            } elseif ($seg2 == "drawings") {

                $sql .= " AND rcate.id_categories = 4";

                if ($seg3 == "bymaincate" && $seg5 == NULL) {
                $sql .= " AND ct.id_categories = $seg4";
                }
                 elseif($seg3 == "bymaincate" && $seg5 == "bystatus"){
                $sql .= " AND ct.id_categories = $seg4 AND r.fk_status = $seg6";
                } elseif ($seg3 == "bysubcate" && $seg5 == NULL) {
                $sql .= " AND s.id_subcategories = $seg4";
                }
                 elseif ($seg3 == "bysubcate" && $seg5 == "bystatus") {
                $sql .= " AND s.id_subcategories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bystatus") {
                    $sql .= " AND r.fk_status = $seg4";
                }
            } elseif ($seg2 == "calls") {

                $sql .= " AND rcate.id_categories = 5";

                if ($seg3 == "bymaincate" && $seg5 == NULL) {
                $sql .= " AND ct.id_categories = $seg4";
                }
                 elseif($seg3 == "bymaincate" && $seg5 == "bystatus"){
                $sql .= " AND ct.id_categories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bysubcate" && $seg5 == NULL) {
                $sql .= " AND s.id_subcategories = $seg4";
                }
                 elseif ($seg3 == "bysubcate" && $seg5 == "bystatus") {
                $sql .= " AND s.id_subcategories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bystatus") {
                    $sql .= " AND r.fk_status = $seg4";
                }
            } elseif ($seg2 == "visits") {

                $sql .= " AND rcate.id_categories = 7";

                if ($seg3 == "bymaincate" && $seg5 == NULL) {
                $sql .= " AND ct.id_categories = $seg4";
                }
                 elseif($seg3 == "bymaincate" && $seg5 == "bystatus"){
                $sql .= " AND ct.id_categories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bysubcate" && $seg5 == NULL) {
                $sql .= " AND s.id_subcategories = $seg4";
                }
                 elseif ($seg3 == "bysubcate" && $seg5 == "bystatus") {
                $sql .= " AND s.id_subcategories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bystatus") {
                    $sql .= " AND r.fk_status = $seg4";
                }
            } elseif ($seg2 == "buysale") {

                $sql .= " AND rcate.id_categories = 3";

                if ($seg3 == "bymaincate" && $seg5 == NULL) {
                $sql .= " AND ct.id_categories = $seg4";
                }
                 elseif($seg3 == "bymaincate" && $seg5 == "bystatus"){
                $sql .= " AND ct.id_categories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bysubcate" && $seg5 == NULL) {
                $sql .= " AND s.id_subcategories = $seg4";
                }
                 elseif ($seg3 == "bysubcate" && $seg5 == "bystatus") {
                $sql .= " AND s.id_subcategories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bystatus") {
                    $sql .= " AND r.fk_status = $seg4";
                }
            } elseif ($seg2 == "tasks") {

                $sql .= " AND rcate.id_categories = 6";

                if ($seg3 == "bymaincate" && $seg5 == NULL) {
                $sql .= " AND ct.id_categories = $seg4";
                }
                 elseif($seg3 == "bymaincate" && $seg5 == "bystatus"){
                $sql .= " AND ct.id_categories = $seg4 AND r.fk_status = $seg6";
                } elseif ($seg3 == "bysubcate" && $seg5 == NULL) {
                $sql .= " AND s.id_subcategories = $seg4";
                }
                 elseif ($seg3 == "bysubcate" && $seg5 == "bystatus") {
                $sql .= " AND s.id_subcategories = $seg4 AND r.fk_status = $seg6";
                } 
                elseif ($seg3 == "bystatus") {
                    $sql .= " AND r.fk_status = $seg4";
                }
            }

            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) {
                $id = $row['id_requests'];
                $var = '<button type="button" class="btn btn-info editbutton"><i class="icon-settings"></i></button> | <a href="' . $baseurl . 'office/deleterequest/' . $id . '/" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
                $i++;

                $query[$key]['action'] = $var;
            }
            $data['records'] = $query;
            return $data;
        }
    }

    function getMenuListCategories() {

        $query = $this->db->get('office_categories');
        $return = array();

        foreach ($query->result() as $category) {
            $return[$category->id_categories] = $category;
            $return[$category->id_categories]->subs = $this->getListSubcategories($category->id_categories); // Get the categories sub categories
        }

        return $return;
    }

    function getListSubcategories($id_office_categories) {
        $this->db->where('fk_office_categories', $id_office_categories);
        $query = $this->db->get('office_subcategories');
        return $query->result();
    }

    //Insert

    function InsertOfficeCategories($insert_data) {
        $this->db->insert('office_categories', $insert_data);
    }

    function InsertOfficeSubCategoires($insert_data) {
        $this->db->insert('office_subcategories', $insert_data);
    }

    function InsertOfficeTypes($insert_data) {
        $this->db->insert('office_types', $insert_data);
    }

    function InsertOfficeClients($insert_data) {

        $phone = $insert_data['phone_clients'];
        
        $sql = "select id_clients from office_clients where phone_clients = $phone";
        $query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to Add ! This Client Already Exists";
	}
        else
            {
            $this->db->insert('office_clients', $insert_data);
            $message="Client Data Added !!";
            }
            return $message;
    }

    function InsertOfficeRequests($insert_data) {


        $this->db->insert('office_requests', $insert_data);
    }

    function InsertOfficeClientsPhones($insert_data) {
        $this->db->insert('phone', $insert_data);
    }

    function InsertRequests($insert_data) {

        $this->db->insert('requests', $insert_data);
    }

    // DrpDwn 

    function getDrpDwnOfficeCategories() {
        $sql = "select * from office_categories";
        $records = $this->db->query($sql)->result();
        $drpdown = array();
        $drpdwn[0] = "Select Category";
        foreach ($records as $record) {
            $drpdwn[$record->id_categories] = $record->name_categories;
        }

        return $drpdwn;
    }

    function getDrpDwnOfficeTypes() {
        $sql = "select * from office_types";
        $records = $this->db->query($sql)->result();
        $drpdown = array();
        $drpdwn[0] = "Select Types";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->name;
        }

        return $drpdwn;
    }

    function getDrpDwnReqCategories() {
        $sql = "select * from req_categories";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Req Category";
        foreach ($records as $record) {
            $drpdwn[$record->id_categories] = $record->name_categories;
        }

        return $drpdwn;
    }

    function getDrpDwnStatusCategories() {
        $sql = "select * from status_categories";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Status";
        foreach ($records as $record) {
            $drpdwn[$record->id_categories] = $record->name_categories;
        }

        return $drpdwn;
    }

    function getDrpDwnCities() {
        $sql = "select * from cities";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select City";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->name;
        }

        return $drpdwn;
    }

    // Delete

    function DeleteOfficeCategories($id) {
        $this->db->where('id_categories', $id);
        $this->db->delete('office_categories');
        $message = " Office Categories Data deleted successfully";
        return $message;
    }

    function DeleteRequests($clientid) { {
            $this->db->where('id_requests', $clientid);
            $this->db->delete('office_requests');
            $message = " Client Request Data deleted successfully";
            return $message;
        }
    }

    function DeleteOfficeSubCategories($id) {
        $this->db->where('id_subcategories', $id);
        $this->db->delete('office_subcategories');
        $message = "Office Sub Categories Data deleted successfully";
        return $message;
    }

    function DeleteOfficeTypes($id) {
        $this->db->where('id', $id);
        $this->db->delete('office_types');
        $message = "Office Types Data deleted successfully";
        return $message;
    }

    function DeleteOfficeClients($id) {
        $sql="select id_requests from office_requests where fk_office_clients=$id";
	$query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to delete foreign key constant failed!";
	}
        else
            {
        $this->db->where('id_clients', $id);
        $this->db->delete('office_clients');
        $message = "Office Types Data deleted successfully";
            }
        return $message;
        
        
        
    }

    function DeletePhoneNumbers($id) {
        $this->db->where('fk_office_clients', $id);
        $this->db->delete('phone');
        $message = "Office Types Data deleted successfully";
        return $message;
    }

    // Special Methods

    function getPhoneNumbers($client_id) {

        $sql = "select number_phone,type_phone from phone where fk_office_clients = $client_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function countTotalRequests($subcateid) {
        //$sql = "select count(*) as total from office_requests r where r.fk_office_subcategories = $id";    
        //$sql = "select count(*) total FROM office_requests r where fk_office_subcategories = $subcateid and fk_status = 1";
        $sql = "select count(*) as total from office_requests r join office_subcategories s join office_categories c join status_categories st where r.fk_office_subcategories = s.id_subcategories and c.id_categories = s.fk_office_categories and r.fk_status = st.id_categories and r.fk_office_subcategories = $subcateid and st.count = 1";

        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countTotalRequestsByStatus($idst) {

        $sql = "select count(*) as countreq from office_requests o where o.fk_status = $idst";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    
    function countTotalRequestsByStatusAndCate($idst,$byrequrl) {
        $sql = "select count(*) as countreq 
                from office_requests r join req_categories c 
                where r.fk_reqcategory = c.id_categories and c.url_categories = '$byrequrl' and fk_status = $idst";
        //$sql = "select count(*) as countreq from office_requests o where o.fk_status = $idst";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function countAllRequests() {

        $sql = "select count(*) as tot from office_requests r where r.fk_status = 1 or r.fk_status = 2 or r.fk_status = 6 or r.fk_status = 7 or r.fk_status = 6 or r.fk_status = 11 or r.fk_status = 12";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    
    function countAllPendingReq($id) {

        $sql = "select count(*) as tot from office_requests r where r.fk_reqcategory = $id and r.fk_status = 1";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countAllConfirmedReq($id) {

        $sql = "select count(*) as tot from office_requests r where r.fk_reqcategory = $id and r.fk_status = 2";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countAllProgressReq($id) {

        $sql = "select count(*) as tot from office_requests r where r.fk_reqcategory = $id and r.fk_status = 6";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countAllDealingReq($id) {

        $sql = "select count(*) as tot from office_requests r where r.fk_reqcategory = $id and r.fk_status = 7";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countAllMakingReq($id) {

        $sql = "select count(*) as tot from office_requests r where r.fk_reqcategory = $id and r.fk_status = 11";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countAllWaitingReq($id) {

        $sql = "select count(*) as tot from office_requests r where r.fk_reqcategory = $id and r.fk_status = 12";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countTotalRequestByCate($id) {
        $sql = "select count(*) as alltotal 
                from office_requests r join office_subcategories s join office_categories c join status_categories sc
                where r.fk_office_subcategories = s.id_subcategories and c.id_categories = s.fk_office_categories and r.fk_status = sc.id_categories and c.id_categories = $id and sc.count = 1";
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countTotalRequestsOfReqCate($id, $reqcate) {
        //$sql = "select count(*) as total from office_requests r where r.fk_office_subcategories = $id ";
        $sql = "select count(*) as total from office_requests r join office_subcategories s join office_categories c join status_categories st where r.fk_office_subcategories = s.id_subcategories and c.id_categories = s.fk_office_categories and r.fk_status = st.id_categories and r.fk_office_subcategories = $id and st.count = 1";

        if ($reqcate == "quotations") {
            $sql .= " AND r.fk_reqcategory = 2";
        } elseif ($reqcate == "meetings") {
            $sql .= " AND r.fk_reqcategory = 1";
        } elseif ($reqcate == "drawings") {
            $sql .= " AND r.fk_reqcategory = 4";
        } elseif ($reqcate == "calls") {
            $sql .= " AND r.fk_reqcategory = 5";
        } elseif ($reqcate == "visits") {
            $sql .= " AND r.fk_reqcategory = 7";
        } elseif ($reqcate == "buysale") {
            $sql .= " AND r.fk_reqcategory = 3";
        } elseif ($reqcate == "tasks") {
            $sql .= " AND r.fk_reqcategory = 6";
        }
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function countTotalReqOfQout($id, $reqcate) {
        $sql = "select count(*) as alltotal 
                from office_requests r join office_subcategories s join office_categories c join status_categories sc
                where r.fk_office_subcategories = s.id_subcategories and c.id_categories = s.fk_office_categories and r.fk_status = sc.id_categories and c.id_categories = $id and sc.count = 1";

        if ($reqcate == "quotations") {
            $sql .= " AND r.fk_reqcategory = 2";
        } elseif ($reqcate == "meetings") {
            $sql .= " AND r.fk_reqcategory = 1";
        } elseif ($reqcate == "drawings") {
            $sql .= " AND r.fk_reqcategory = 4";
        } elseif ($reqcate == "calls") {
            $sql .= " AND r.fk_reqcategory = 5";
        } elseif ($reqcate == "visits") {
            $sql .= " AND r.fk_reqcategory = 7";
        } elseif ($reqcate == "buysale") {
            $sql .= " AND r.fk_reqcategory = 3";
        } elseif ($reqcate == "tasks") {
            $sql .= " AND r.fk_reqcategory = 6";
        }
        $query = $this->db->query($sql)->result();
        return $query;
    }

    function getCityNameById($id) {

        $sql = "select name as cityname from cities where id = '$id'";
        $records = $this->db->query($sql)->result();
        return $records[0]->cityname;
    }

    function getSocietyNameById($id) {

        $sql = "select name as societyname from societies where id = '$id'";
        $records = $this->db->query($sql)->result();
        return $records[0]->societyname;
    }

    function getClientProfileData($id) {
        $sql = "select * from office_clients oc join office_categories ct where fk_categories = ct.id_categories and  id_clients = '$id'";
        $records = $query = $this->db->query($sql)->result_array();
        return $records;
    }

    function getClientRequests($id) {
        //$sql = "SELECT * FROM requests r join office_clients c join req_categories rq join office_categories ct WHERE r.fk_office_clients = c.id_clients and rq.id_categories = r.fk_reqcategories and ct.id_categories = c.fk_categories";
        /* $sql = "SELECT r.id_requests,rq.bg_colour as bgcolour,rq.id_categories as reqcateid,rq.class_categories as reqclass ,rq.name_categories as reqcate, t.name as marla, r.date_requests as reqdate, r.exdate_requests as dateexp ,r.updated_date as updateddate,r.status_requests as reqstatus,r.progress_requests as progst, os.name_subcategories as subcate, ct.name_categories as maincate,ci.name as cityname,s.name as societyname
          FROM requests r join office_clients c join office_subcategories os join office_categories ct join office_types t
          join cities ci join societies s join req_categories rq
          where r.fk_office_clients = c.id_clients and ct.id_categories = os.fk_office_categories
          and t.id = c.fk_office_types and ci.id = c.fk_cities and s.id = c.fk_societies and rq.id_categories = r.fk_reqcategories
          and c.id_clients = '$id'"; */

        $sql = "select * ,rq.bg_colour as bgcolour,rq.id_categories as reqcateid,rq.class_categories as reqclass ,rq.name_categories as reqcate,r.date_requests as reqdate, r.exdate_requests as dateexp ,r.updated_date as updateddate,r.status_requests as reqstatus,r.progress_requests as progst
FROM requests r join office_clients c join req_categories rq
WHERE r.fk_reqcategories = rq.id_categories and r.fk_office_clients = c.id_clients and fk_office_clients = '$id'";
        $records = $query = $this->db->query($sql)->result_array();
        return $records;
    }

    function getReqCategories() {
        $this->db->where('status_categories', 1);
        $this->db->order_by("orderby_categories", "asc");
        $query = $this->db->get('req_categories')->result_array();
        return $query;
    }

    function countGraficTotalClients() {

        $sql = "SELECT COUNT(id_clients) as count,MONTHNAME(date_clients) as month_name FROM office_clients WHERE  YEAR(date_clients) = '" . date('Y') . "'
        GROUP BY YEAR(date_clients),MONTH(date_clients)";
        $query = $this->db->query($sql);

        $records = $query->result();

        $data = [];

        foreach ($records as $row) {
            $data['label'][] = $row->month_name;
            $data['data'][] = (int) $row->count;
        }
        return $data;
    }

    function countGraficTotalConstClients() {

        $sql = "SELECT COUNT(id_clients) as count,MONTHNAME(date_clients) as month_name FROM office_clients WHERE fk_categories = 1 and YEAR(date_clients) = '" . date('Y') . "'
        GROUP BY YEAR(date_clients),MONTH(date_clients)";
        $query = $this->db->query($sql);

        $records = $query->result();

        $data = [];

        foreach ($records as $row) {
            $data['data'][] = (int) $row->count;
        }
        return $data;
    }

    function countGraficTotalRenovaClients() {

        $sql = "SELECT COUNT(id_clients) as count,MONTHNAME(date_clients) as month_name FROM office_clients WHERE fk_categories = 2 and YEAR(date_clients) = '" . date('Y') . "'
        GROUP BY YEAR(date_clients),MONTH(date_clients)";
        $query = $this->db->query($sql);

        $records = $query->result();

        $data = [];

        foreach ($records as $row) {
            $data['data'][] = (int) $row->count;
        }
        return $data;
    }

    function countGraficTotalProClients() {

        $sql = "SELECT COUNT(id_clients) as count,MONTHNAME(date_clients) as month_name FROM office_clients WHERE fk_categories = 3 and YEAR(date_clients) = '" . date('Y') . "'
        GROUP BY YEAR(date_clients),MONTH(date_clients)";
        $query = $this->db->query($sql);

        $records = $query->result();

        $data = [];

        foreach ($records as $row) {
            $data['data'][] = (int) $row->count;
        }
        return $data;
    }

    function countGraficTotalDesgClients() {

        $sql = "SELECT COUNT(id_clients) as count,MONTHNAME(date_clients) as month_name FROM office_clients WHERE fk_categories = 4 and YEAR(date_clients) = '" . date('Y') . "'
        GROUP BY YEAR(date_clients),MONTH(date_clients)";
        $query = $this->db->query($sql);

        $records = $query->result();

        $data = [];

        foreach ($records as $row) {
            $data['data'][] = (int) $row->count;
        }
        return $data;
    }

}
