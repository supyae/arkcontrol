<?php

namespace App\Http\Controllers;

use App\Repositories\Client\ClientRepository;
use App\Repositories\Others\BusinessTypeRepository;
use App\Repositories\Others\CountryRepository;
use App\Repositories\Others\DeploymentSiteRepository;
use Illuminate\Http\Request;

class ClientController extends ApiController
{
    private $repository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->repository = $clientRepository;
    }

    public function getSelectors()
    {

        $countries = (new CountryRepository())->getList();
        $business = (new BusinessTypeRepository())->getList();
        $deployment = (new DeploymentSiteRepository())->getList();

        $data = [
            'countries'  => $countries,
            'business'   => $business,
            'deployment' => $deployment
        ];
        return response()->json($data);
    }

    public function getRules()
    {
        $rules = [
            'name'                 => 'required|max:20',
            'address'              => 'required|max:100',
            'contact_person_name'  => 'required|max:20',
            'contact_person_phone' => 'required|max:10',
            'contact_person_email' => 'required|email',
            'country_id'           => 'required',
            'business_id'          => 'required',
            'deployment_id'        => 'required'
        ];
        return $rules;
    }

    public function index()
    {
        $relations = ['country', 'business_type', 'deployment_site'];
        $data = $this->repository->getByPagination($relations, 5);
        return $this->setStatusCode(200)
            ->respondWithSuccess("Client Data", $data);
    }

    public function get($id)
    {
        $relations = ['country', 'business_type', 'deployment_site'];
        $data = $this->repository->getByRelationsId($relations, $id);
        return $this->setStatusCode(200)
            ->respondWithSuccess("Client Data", $data);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        //print_r($request->all());
        $respond = $this->setValidationRules($this->getRules())->validateData($request->all());
        if ($respond) {
            return $respond;
        }

        $post_data = $this->getData($request);

        $respond_data = $this->repository->create($post_data);
        return $this->setStatusCode(200)
            ->respondWithSuccess("Client Data", $respond_data);
    }


    public function update(Request $request, $id)
    {
        $respond = $this->setValidationRules($this->getRules())->validateData($request->all());
        if ($respond) {
            return $respond;
        }
        $post_data = $this->getData($request);

        $respond_data = $this->repository->update($post_data, $id);
        return $this->setStatusCode(200)
            ->respondWithSuccess("Client Data", $respond_data);

    }

    /**
     * @param Request $request
     * @return array
     */
    public function getData(Request $request)
    {
        $input = $request->all();
        $filter_input_data = $this->repository->getFillables();
        $post_data = [];
        foreach ($input as $key => $value) {
            if (in_array($key, $filter_input_data)) {
                $post_data[$key] = $value;
            }
        }
        return $post_data;
    }
}
