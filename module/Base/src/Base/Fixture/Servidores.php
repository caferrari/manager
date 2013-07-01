<?php

namespace Base\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Base\Entity\Usuario as UsuarioEntity;

class Servidores extends AbstractFixture
{

    protected $fp;
    protected $fields = array();
    protected $em;

    protected $orgaoCache = array();
    protected $setorCache = array();
    protected $cargoEfetivoCache = array();
    protected $cargoComissaoCache = array();
    protected $simboloCache = array();

    protected function fixString($string)
    {
        $ignore = explode(', ', 'A, E, DE, DO, DA, EM, DAS, DOS');

        $str = implode(
            ' ', array_map(
                function ($str) use ($ignore) {
                    if (in_array($str, $ignore)) return mb_strtolower($str);
                    return mb_convert_case($str, MB_CASE_TITLE);
                },
                explode(' ', $string)
            )
        );

        return $str;
    }

    protected function mapFile()
    {

        $line = fgetcsv($this->fp, 4096, ';');

        $this->mapeableTxtFields = explode(';', 'NOME;MATRICULA;LOTAÇÃO;CARGO EFETIVO;CARGO EM COMISSÃO;ÓRGÃO;SÍMBOLO;IDENTIDADE NUMERO;IDENTIDADE ÓRGÃO;LIXO;INDENTIDADE UF;CPF;DATA DE NASCIMENTO;SITUACAO FUNCIONAL');
        $this->mapeableFields    = explode(';', 'nome;matricula;lotacao;cargoEfetivo;cargoComissao;orgao;simbolo;identidade;identidadeOrgao;LIXO;identidadeUf;cpf;nascimento;situacao');

        $convertCase = array('nome', 'lotacao', 'cargoEfetivo', 'cargoComissao', 'orgao');

        $map = array();
        foreach ($line as $f) {
            $index = array_search($f, $this->mapeableTxtFields);
            $map[] = $this->mapeableFields[$index];
        }

        $items = array();
        while ($data = fgetcsv($this->fp, 4096, ';')) {
            $tmp = array();
            foreach ($data as $index => $value) {
                if (in_array($map[$index], $convertCase)) {
                    $tmp[$map[$index]] = $this->fixString($value);
                } else {
                    $tmp[$map[$index]] = $value;
                }

            }
            $items[] = $tmp;
        }
        return $items;

    }

    protected function loadOrgaos($items)
    {

        $repository = $this->em->getRepository('Base\Entity\Orgao');
        $service = new \Base\Service\Orgao($this->em);

        foreach ($items as $item) {

            if (!isset($item['orgao'])) {
                continue;
            }

            $nome = $item['orgao'];

            if (isset($this->orgaoCache[$nome])) {
                continue;
            }

            $orgao = $repository->findOneByNome($nome);

            if (!$orgao) {
                $data = array(
                    'nome' => $nome
                );
                $orgao = $service->insert($data);
            }

            $this->orgaoCache[$nome] = $orgao;

        }
    }

    protected function loadCargoEfetivo($items)
    {

        $repository = $this->em->getRepository('Base\Entity\CargoEfetivo');
        $service = new \Base\Service\CargoEfetivo($this->em);

        foreach ($items as $item) {

            if (!isset($item['cargoEfetivo']) || empty($item['cargoEfetivo'])) {
                continue;
            }

            $nome = $item['cargoEfetivo'];

            if (isset($this->cargoEfetivoCache[$nome])) {
                continue;
            }

            $cargoEfetivo = $repository->findOneByNome($nome);

            if (!$cargoEfetivo) {
                $data = array(
                    'nome' => $nome
                );

                $cargoEfetivo = $service->insert($data);
            }

            $this->cargoEfetivoCache[$nome] = $cargoEfetivo;

        }
    }

    protected function loadCargoComissao($items)
    {

        $repository = $this->em->getRepository('Base\Entity\CargoComissao');
        $service = new \Base\Service\CargoComissao($this->em);

        foreach ($items as $item) {

            if (!isset($item['cargoComissao']) || empty($item['cargoComissao'])) {
                continue;
            }

            $nome = $item['cargoComissao'];

            if (isset($this->cargoComissaoCache[$nome])) {
                continue;
            }

            $cargoComissao = $repository->findOneByNome($nome);

            if (!$cargoComissao) {
                $data = array(
                    'nome' => $nome
                );
                $cargoComissao = $service->insert($data);
            }

            $this->cargoComissaoCache[$nome] = $cargoComissao;

        }
    }

    protected function loadSimbolo($items)
    {

        $repository = $this->em->getRepository('Base\Entity\Simbolo');
        $service = new \Base\Service\Simbolo($this->em);

        foreach ($items as $item) {

            if (!isset($item['simbolo']) || empty($item['simbolo'])) {
                continue;
            }

            $nome = $item['simbolo'];

            if (isset($this->simboloCache[$nome])) {
                continue;
            }

            $simbolo = $repository->findOneByNome($nome);

            if (!$simbolo) {
                $data = array(
                    'nome' => $nome
                );
                $simbolo = $service->insert($data);
            }

            $this->simboloCache[$nome] = $simbolo;

        }
    }

    protected function loadSetores($items)
    {

        $repository = $this->em->getRepository('Base\Entity\Setor');
        $service = new \Base\Service\Setor($this->em);

        foreach ($items as $item) {

            if (!isset($item['lotacao'])) {
                return;
            }

            $nome = $item['lotacao'];

            if (isset($this->setorCache[$nome])) {
                continue;
            }

            $lotacao = $repository->findOneByNome($nome);

            if (!$lotacao) {
                $data = array(
                    'nome' => $nome,
                    'lotacao' => $nome,
                    'orgao' => $this->orgaoCache[$item['orgao']]
                );
                $lotacao = $service->insert($data);
            }

            $this->setorCache[$nome] = $lotacao;

        }
    }

    protected function loadServidores($items)
    {

        $repository = $this->em->getRepository('Base\Entity\Servidor');
        $service = new \Base\Service\Servidor($this->em);

        foreach ($items as $item) {

            $matricula = $item['matricula'];

            $servidor = $repository->findOneByMatricula($matricula);

            $data = $item;

            if (isset($data['orgao'])) {
                $data['orgao'] = $this->orgaoCache[$data['orgao']];
            }

            if (isset($data['cargoEfetivo']) && $data['cargoEfetivo']) {
                $data['cargoEfetivo'] = $this->cargoEfetivoCache[$data['cargoEfetivo']];
            } else {
                unset ($data['cargoEfetivo']);
            }

            if (isset($data['cargoComissao']) && $data['cargoComissao']) {
                $data['cargoComissao'] = $this->cargoComissaoCache[$data['cargoComissao']];
            } else {
                unset ($data['cargoComissao']);
            }

            if (isset($data['simbolo']) && $data['simbolo']) {
                $data['simbolo'] = $this->simboloCache[$data['simbolo']];
            } else {
                unset ($data['simbolo']);
            }

            if (isset($data['lotacao']) && $data['lotacao']) {
                $data['lotacao'] = $this->setorCache[$data['lotacao']];
            } else {
                unset ($data['lotacao']);
            }

            if (isset($data['cpf'])) {
                $data['cpf'] = preg_replace('@[^0-9]+@', '', $data['cpf']);
            }

            if (preg_match('@^[0-9]{2}/[0-9]{2}/[0-9]{4}$@', $data['nascimento'])) {
                $data['nascimento'] = preg_replace('@^([0-9]{2})/([0-9]{2})/([0-9]{4})$@', '$3-$2-$1', $data['nascimento']);
            }

            if (!$servidor) {
                $servidor = $service->insert($data);
            }

        }
    }

    public function load(ObjectManager $manager)
    {

        $this->em = $manager;

        $filePath = getcwd() . '/data/resources/SERVIDORES-2013.TXT';

        if (!file_exists($filePath)) {
            throw new \RuntimeException("Arquivo $filePath não encontrado!");
        }

        $this->fp = fopen($filePath, 'r');
        stream_filter_append($this->fp, 'convert.iconv.ISO-8859-1/UTF-8', STREAM_FILTER_READ);

        $items = $this->mapFile();

        $this->loadOrgaos($items);
        $this->loadSetores($items);

        $this->loadCargoEfetivo($items);
        $this->loadCargoComissao($items);
        $this->loadSimbolo($items);

        $this->loadServidores($items);

    }

}