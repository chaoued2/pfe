<?php


class IndicatorDao extends BaseDao {


    public function saveIndicator(Indicators $indicator)  {


        try {
            $indicator->save();
        } catch (Exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode(), $e);
        }


    }

    public function getIndicatorByName($name) {

        try {

            $q = Doctrine_Query::create()
                ->from('Indicators')
                ->where('nom = ?', trim($name));

            return $q->fetchOne();

        } catch (Exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode(), $e);
        }

    }

    public function deleteIndicators($toDeleteIds) {

        try {

            $q = Doctrine_Query::create()->delete('Indicators')
                ->whereIn('id', $toDeleteIds);

            return $q->execute();

        } catch (Exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode(), $e);
        }

    }

    public function isExistingIndicatorName($indicatorName) {

        try {

            $q = Doctrine_Query:: create()->from('Indicators i')
                ->where('i.nom = ?', trim($indicatorName));

            if ($q->count() > 0) {
                return true;
            }

            return false;

        } catch (Exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode(), $e);
        }

    }

    public function getIndicatorList() {

        try {

            $q = Doctrine_Query::create()->from('Indicators')
                ->orderBy('nom');

            return $q->execute();

        } catch (Exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode(), $e);
        }

    }

    public function getIndicatorById($id) {

        try {
            return Doctrine::getTable('Indicators')->find($id);
        } catch (Exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode(), $e);
        }

    }





}

?>