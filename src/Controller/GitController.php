<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Description of GitController
 *
 * @author Sampath Kumar G
 */
class GitController extends Controller {

    public function index() {
        
        return $this->render('git/index.html.twig', array(
            'tableData' => $this->getSymfonyRepos()
        ));
    }
    
    
    private function getSymfonyRepos() {
        $url = 'https://api.github.com/search/repositories?q=language:php+topic:symfony&sort=stars&order=desc&page=1&per_page=1800';
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: GIT-test-app'));
            $output = curl_exec($ch);
            curl_close($ch);
            
            $repos = (array)json_decode($output);
            
            $response['totalCount'] = $repos['total_count'];
            $response['data'] = [];
            foreach($repos['items'] as $repo) {
                $item = (array)$repo;
                $owner = (array)$item['owner'];
                $license = (array)$item['license'];
                $repo = [
                    'name' => $item['name'],
                    'url' => $item['html_url'],
                    'owner' => [
                        'avatar' => $owner['avatar_url'],
                        'url' => $owner['url'],
                        'type' => $owner['type']
                    ],
                    'description' => $item['description'],
                    'createdOn' => $item['created_at'],
                    'updatedOn' => $item['updated_at'],
                    'cloneURL' => $item['clone_url'],
                    'homepage' => !empty($item['homepage']) ? $item['homepage'] : '',
                    'size' => $item['size'],
                    'forks' => $item['forks_count'],
                    'stars' => $item['stargazers_count'],
                    'openIssues' => $item['open_issues_count'],
                    'issuesURL' => $item['issues_url'],
                    'license' => !empty($license) && isset($license['name'])? $license['name'] : ''
                ];
                $response['data'][] = $repo;
            }
            
            return $response;
        } catch (\Exception $ex) {
            return false;
        }
    }

}